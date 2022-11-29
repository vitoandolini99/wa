import csv
from flask import *
import re

ucastnici = []


def addcsv():
    ucastnici.clear()

    rs = []
    with open('ucastnici.csv', 'r') as cfile:
        csvreader = csv.reader(cfile)
        next(csvreader)
        for rr in csvreader:
            if rr:
                rs.append(rr)

        for r in rs:
            fp = []
            for c in r:
                if r.index(c) == 0:
                    fp.append(str(c))
                elif r.index(c) == 1:
                    fp.append(str(c))
                elif r.index(c) == 2:
                    fp.append(str(c))
                elif r.index(c) == 3:
                    fp.append(str(c))
            ucastnici.append((fp[0], fp[1], fp[2], fp[3]))


addcsv()

tridy = ["c1a", "c1b", "c1c", "c1d",
         "c2a", "c2b", "c2c", "c2d",
         "c3a", "C3b", "C3c", "c3d",
         "c4a", "c4b", "c4c", "c4d",
         "e1", "e2", "e3", "e4",
         "a1a", "a1b", "a2a", "a2b",
         "a3a", "a3b", "a4a", "a4b"]

app = Flask(__name__, static_url_path='/static', static_folder='static', template_folder='templates')


@app.route('/email', methods=['GET', 'POST'])
def email():
    return render_template('/email.html'), 200


@app.route('/', methods=['GET', 'POST'])
def index():
    return render_template('prvni_stranka.html', ucastnici=ucastnici), 200


@app.route('/druha_stranka', methods=['GET', 'POST'])
def druha_stranka():
    return render_template('/druha_stranka.html', zprava="Tajná zpráva.."), 200


@app.route('/registrace', methods=['GET', 'POST'])
def registrace():
    if request.method == 'POST':
        nick = request.form['nick']
        je_plavec = request.form['je_plavec']
        kamos = request.form['kanoe_kamarad']
        trida = request.form['trida']

        if not re.search('[\W_ ]', nick):
            if not re.search('[\W_ ]]', kamos):
                if je_plavec.lower() == 'ano':
                    if trida.lower() in tridy:
                        f = open('ucastnici.csv', 'a', newline='')
                        writer = csv.writer(f)
                        writer.writerow([nick, je_plavec.lower().capitalize(), trida.lower().capitalize(), kamos])
                        f.close()

                        addcsv()

    return render_template('/registrace.html'), 200


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8080)
