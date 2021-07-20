#!/usr/bin/python3

import cgi
import cgitb
cgitb.enable()
from random import randint

n = randint(3,21)
while n%3 != 0:
    n = randint(3,21)

print("Content-type: text/html\n")
print("""
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Galerie</title>
    <style>
    h1 {
        color: white;
    }
    body {
        background-color: black;
    }
    img {
    }
    .galery {
        column-count: 3;
        width: 2400px;
    }
    </style>
</head>
<body>

""")

print("<h1>Zufallsgalerie mit {} Bildern</h1>".format(n))
print('<div class="galery">')

for i in range(n):
    print('<img src="https://picsum.photos/800/600?random=' + str(i) + '">')

print('</div>')
print("""
</body>
</html>
""")
