# coding=utf-8
import datetime
import json
import os
import sys
import time
from os import listdir
from os.path import isfile, join


# -------------------------------------------------------------------------------------
# Hilfsfunktionen
# -------------------------------------------------------------------------------------

# enc_print zur Behebung des UTF-Problems mit dem Übungsserver
def enc_print(string='', encoding='utf8'):
    sys.stdout.buffer.write(string.encode(encoding) + b'\n')


# Erzeugt einen HTTP-Redirect
def redirect(location):
    print("Status: 303 See Other")
    print("Location: {}".format(location))
    print()


# Liefert die aktuelle Uhrzeit im Format Jahr-Monat-Tag-Stunde-Minute-Sekunde
def get_timestamp():
    return time.strftime("%Y-%m-%d-%H-%M-%S")


def readable_timestamp(timestamp):
    return datetime.datetime.strptime(timestamp, "%Y-%m-%d-%H-%M-%S").strftime("%d.%m.%Y, %H:%M Uhr")


# -------------------------------------------------------------------------------------
# Layout-Funktionen
# -------------------------------------------------------------------------------------

# Gibt den Header der Seite mit optionalem Titel aus
def print_header(title=""):
    enc_print("Content-type: text/html\n")

    enc_print("""
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>{}</title>
    <link rel="stylesheet" href="style.css">
</head>
<body> 
    <h1>{}</h1>
    """.format(title, title))


# Gibt den Footer aus
def print_footer():
    enc_print("""
</body>
</html>
    """)


def print_navigation():
    enc_print("""
        <p>
        <a href="posts-create.py">Post hinzufügen</a>
        <a href="tags-show.py">Tags anzeigen</a>
        </p>""")


def print_posts(posts):
    if len(posts) == 0:
        enc_print("Keine Posts bis jetzt :(")
    else:

        for p in posts:
            enc_print("<table>")
            enc_print("""
            <tr><th class="title">{}</th></tr>
            <tr><td class="min">{}</td></tr>
            <tr><td class="content">{}</td></tr>
            <tr><td class="tags">
            """.format(p["title"],
                        readable_timestamp(p["published"]),
                        p["content"]))

            for t in p["tags"]:
                enc_print("""
                <a href="tags-show.py?tag={}">#{}</a>""".format(t,t))

            enc_print("""
            </td></tr>""")
            enc_print("</table>")


def print_tags(tags):
    sorted_tags = sorted(tags, key=str.lower)

    if len(sorted_tags) == 0:
        enc_print("Keine Tags bis jetzt :(")
    else:
        enc_print("<table>")

        enc_print('<tr><td class="tags">')

        for t in sorted_tags:
            enc_print("""
            <a href="tags-show.py?tag={}">#{}</a><br>""".format(t,t))

        enc_print("</td></tr>")


        enc_print("</table>")


def print_form():
    enc_print("""
    <form action="posts-store.py" method="post" style="margin-top: 2em">

        <label for="title">Titel:</label>
        <input type="text" name="title" id="title" required><br>
        <label for="content">Inhalt:</label>
        <textarea type="text" name="content" id="content" required></textarea><br>
        <label for="tags">Tags:</label>
        <input type="text" name="tags" id="tags"><br>

        <button>Speichern</button>

    </form>
    """)


def print_exception_page(title, message, exception):
    print_header(title)
    enc_print("<p>{}</p>".format(message))

    # Exception ausgeben
    enc_print(repr(exception))

    print_footer()


# -------------------------------------------------------------------------------------
# IO-Funktionen
# -------------------------------------------------------------------------------------

POSTS_PATH = "posts/"


def write_post(filename, post):
    with open(join(POSTS_PATH, filename), 'w') as outfile:
        json.dump(post, outfile)

def read_post(filename):
    with open(join(POSTS_PATH, filename), 'r') as json_file:
        return json.load(json_file)

def read_all_posts():
    file_names = [f for f in listdir(POSTS_PATH) if isfile(join(POSTS_PATH, f))]

    posts = [read_post(f) for f in file_names]

    sorted_posts = sorted(posts, key=lambda t: t["published"], reverse=True)

    return sorted_posts


# -------------------------------------------------------------------------------------
# Post-Funktionen
# -------------------------------------------------------------------------------------

def create_post(title, tags, content):
    timestamp = get_timestamp()

    tags = tags.replace(" ","")

    tag_array = []
    if tags:
        tag_array = tags.split("#")
        tag_array.pop(0)

    post = {
        "title": title,
        "published": timestamp,
        "tags": tag_array,
        "content": content
    }

    return post
