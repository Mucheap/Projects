from backend.draft import build_reply

def test_build_reply():
    reply = build_reply('kanji')
    assert 'http' in reply
