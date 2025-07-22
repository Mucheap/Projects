# Conversation Discovery & Reply Drafting Assistant

```
flowchart TD
    A[GitHub Actions] -->|fetch RSS| B(Backend Fetcher)
    B --> C{SQLite/Supabase}
    C --> D(Classifier)
    D --> E(Draft Generator)
    E --> F[Drafts Table]
    F -->|review| G[Next.js Dashboard]
```

## Local Run Steps
1. `git clone <repo>`
2. `cp .env.example .env`
3. `pip install -r requirements.txt`
4. `python -m backend.main init`
5. `python -m backend.main fetch`
6. `python -m backend.main classify`
7. `python -m backend.main draft`
8. `cd frontend && npm install && npm run dev`

See `backend/*.yaml` to customize keywords and templates.
