import os
import random
import requests
from pathlib import Path
import yaml
from jinja2 import Template
from .db import SessionLocal, Post, Draft

TEMPLATES_PATH = Path(__file__).resolve().parent / 'templates.yaml'
OLLAMA_URL = os.getenv('OLLAMA_URL', 'http://localhost:11434')
BASE_PROMPT = "You are a helpful assistant for language learners. Rewrite the following reply in a friendly tone:\n"


def load_templates():
    if TEMPLATES_PATH.exists():
        return yaml.safe_load(TEMPLATES_PATH.read_text())
    return {}

TEMPLATES = load_templates()


def call_ollama(text):
    try:
        r = requests.post(f"{OLLAMA_URL}/api/generate", json={"model": "llama3", "prompt": BASE_PROMPT + text, "stream": False}, timeout=10)
        if r.ok:
            return r.json().get("response", text)
    except Exception:
        pass
    return text


def build_reply(topic):
    conf = TEMPLATES.get(topic)
    if not conf:
        return None
    tip = random.choice(conf.get('tips', ['Study every day!']))
    free_link = conf.get('free')
    premium_line = random.choice(conf.get('premium_lines', [])) if conf.get('premium_lines') else ''
    tmpl = Template("{{tip}} {{free_link}} {{premium_line}}")
    raw = tmpl.render(tip=tip, free_link=free_link, premium_line=premium_line)
    if raw.count('http') > 1:
        raw = tmpl.render(tip=tip, free_link=free_link, premium_line='')
    return call_ollama(raw)


def run():
    session = SessionLocal()
    for post in session.query(Post).filter(Post.topic != None, Post.drafted == False):
        reply = build_reply(post.topic)
        if reply:
            session.add(Draft(post_id=post.id, reply=reply))
            post.drafted = True
    session.commit()
    session.close()

if __name__ == '__main__':
    run()
