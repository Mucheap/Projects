import os
from sqlalchemy import create_engine, Column, Integer, String, Text, Boolean, DateTime
from sqlalchemy.orm import declarative_base, sessionmaker
from datetime import datetime

DATABASE_URL = os.getenv('DATABASE_URL', 'sqlite:///data.db')
engine = create_engine(DATABASE_URL)
SessionLocal = sessionmaker(bind=engine)
Base = declarative_base()

class Post(Base):
    __tablename__ = 'posts'
    id = Column(Integer, primary_key=True)
    source = Column(String)
    url = Column(String, unique=True)
    title = Column(String)
    content = Column(Text)
    topic = Column(String)
    score = Column(Integer)
    drafted = Column(Boolean, default=False)
    created_at = Column(DateTime, default=datetime.utcnow)

class Draft(Base):
    __tablename__ = 'drafts'
    id = Column(Integer, primary_key=True)
    post_id = Column(Integer)
    reply = Column(Text)
    posted = Column(Boolean, default=False)
    created_at = Column(DateTime, default=datetime.utcnow)

def init_db():
    Base.metadata.create_all(engine)
