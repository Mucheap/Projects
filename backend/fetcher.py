import feedparser
from pathlib import Path
import yaml
from .db import SessionLocal, Post

CONFIG_PATH = Path(__file__).resolve().parent / 'sources.yaml'


def load_sources():
    if CONFIG_PATH.exists():
        return yaml.safe_load(CONFIG_PATH.read_text())
    return []


def fetch():
    session = SessionLocal()
    for src in load_sources():
        feed = feedparser.parse(src['url'])
        for entry in feed.entries:
            if session.query(Post).filter_by(url=entry.link).first():
                continue
            post = Post(
                source=src.get('name', src['url']),
                url=entry.link,
                title=entry.get('title', '')[:250],
                content=getattr(entry, 'summary', '')[:1000],
            )
            session.add(post)
    session.commit()
    session.close()

if __name__ == '__main__':
    from .db import init_db
    init_db()
    fetch()
