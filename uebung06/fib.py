#!/usr/bin/python3

import cgi
import cgitb

cgitb.enable()

error = False

def fib(x):
    if x==1 or x==2:
        return 1
    return fib(x-1)+fib(x-2)

try:
    # FieldStorage-Instanz erzeugen
    form = cgi.FieldStorage(encoding='utf8')

    # Zugriff auf Parameter (nach Integer konvertieren!)
    n = int(form.getvalue('n'))

    # Ergebnis berechnen
    fib_n = fib(n)

except:
    error = True

# Ausgabe
print("Content-type: text/html\n")

print("""
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Fib</title>
</head>
<body>

""")

if error:
    print("<h1>Fehler</h1><p>Bei der Abarbeitung ist ein Fehler aufgetreten. Schade.</p>")

else:
    print("""
        <h1>Fib</h1>

        <p>Die {}-te Fibonacci-Zahl ist {}</p>
    """.format(n, fib_n))

print("""
</body>
</html>
""")
