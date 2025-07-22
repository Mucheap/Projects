from backend.draft import build_reply

def test_one_link():
    reply = build_reply('hiragana')
    assert reply.count('http') <= 1
