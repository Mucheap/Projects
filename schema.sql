CREATE TABLE posts (
  id serial PRIMARY KEY,
  source text,
  url text UNIQUE,
  title text,
  content text,
  topic text,
  score integer,
  drafted boolean default false,
  created_at timestamp default current_timestamp
);

CREATE TABLE drafts (
  id serial PRIMARY KEY,
  post_id integer references posts(id),
  reply text,
  posted boolean default false,
  created_at timestamp default current_timestamp
);
