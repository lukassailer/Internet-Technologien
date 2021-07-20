#!/usr/bin/python3
# coding=utf-8

import cgi

from posts_lib import *

try:
    form = cgi.FieldStorage(encoding='utf8')

    title = form.getfirst('title')
    assert title is not None

    content = form.getfirst('content')
    assert content is not None

    tags = form.getfirst('tags')

    post = create_post(title,tags,content)
    write_post(post["published"], post)

    # Weiterleitung auf Übersichtsseite
    redirect("posts-show.py")


# Rudimentäres Error-Handling ...
except Exception as e:
    print_exception_page("Fehler", "Fehler beim Hinzufügen!", e)
