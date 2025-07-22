from collections import defaultdict
from pathlib import Path
import yaml
from .db import SessionLocal, Post

KEYWORDS_PATH = Path(__file__).resolve().parent / 'keywords.yaml'


def load_keywords():
    if KEYWORDS_PATH.exists():
        return yaml.safe_load(KEYWORDS_PATH.read_text())
    return {}

KEYWORDS = load_keywords()


def classify(text: str):
    scores = defaultdict(int)
    for topic, words in KEYWORDS.items():
        for w in words:
            if w.lower() in text.lower():
                scores[topic] += 1
    if not scores:
        return None, 0
    topic = max(scores, key=scores.get)
    return topic, scores[topic]


def run():
    session = SessionLocal()
    for post in session.query(Post).filter_by(topic=None):
        topic, score = classify(post.title + ' ' + post.content)
        post.topic = topic
        post.score = score
    session.commit()
    session.close()

if __name__ == '__main__':
    run()
