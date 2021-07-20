#!/usr/bin/python3
# coding=utf-8

from posts_lib import *
import cgi

form = cgi.FieldStorage(encoding='utf8')

tag = form.getfirst("tag")

if tag:
    all_posts = read_all_posts()
    filtered_posts = []
    for p in all_posts:
        if tag in p["tags"]:
            filtered_posts.append(p)
    print_header("#{}".format(tag))
    print_posts(filtered_posts)
    print_navigation()
    print_footer()

else:
    all_posts = read_all_posts()
    unique_tags = []
    for p in all_posts:
        for t in p["tags"]:
            if t not in unique_tags:
                unique_tags.append(t)
    print_header("Tags")
    print_tags(unique_tags)
    print_navigation()
    print_footer()
