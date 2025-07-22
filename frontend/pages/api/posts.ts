import type { NextApiRequest, NextApiResponse } from 'next'
import { open } from 'sqlite'
import sqlite3 from 'sqlite3'

export default async function handler(req: NextApiRequest, res: NextApiResponse) {
  const db = await open({ filename: '../data.db', driver: sqlite3.Database })
  const posts = await db.all('select posts.id, posts.title, drafts.reply from posts join drafts on posts.id = drafts.post_id where drafts.posted = 0')
  res.status(200).json(posts)
}
