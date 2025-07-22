from backend.classifier import classify

def test_classifier():
    topic, score = classify('I am learning hiragana and kana')
    assert topic == 'hiragana'
    assert score > 0
