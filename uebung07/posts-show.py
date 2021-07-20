#!/usr/bin/python3
# coding=utf-8

from posts_lib import *
import cgi

form = cgi.FieldStorage(encoding='utf8')

all_posts = read_all_posts()

# Ab hier:Ausgabe des HTML-Codes
print_header("Mein Blog")
print_posts(all_posts)
print_navigation()
print_footer()
