import sys
from . import fetcher, classifier, draft
from .db import init_db

COMMANDS = {
    'fetch': fetcher.fetch,
    'classify': classifier.run,
    'draft': draft.run,
    'init': init_db,
}

if __name__ == '__main__':
    cmd = sys.argv[1] if len(sys.argv) > 1 else 'fetch'
    if cmd in COMMANDS:
        COMMANDS[cmd]()
    else:
        print('Usage: python -m backend.main [fetch|classify|draft|init]')
