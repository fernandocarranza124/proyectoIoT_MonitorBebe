import requests
import threading
import random
import datetime
import hashlib
import sched, time
import mysql.connector


def insertarPulso(idSensor, sensorKey,hora):
    #threading.Timer(5.0, insertarPulso(sensorKey)).start()
    
    
    valor = random.randint(70, 140)
    
    firma = sensorKey+hora
    encript = (hashlib.md5(firma.encode())).hexdigest()
    URL="http://192.168.0.3/servidor/conexiones/insert.php?idSensor="+(str(idSensor))+"&certificado="+(str(encript))+"&valor="+(str(valor))+"&hora="+(str(hora))
    print (URL)
    r = requests.get(url = URL, params="")
    r.raise_for_status()
    print ("vuelta")
    
def insertarTemperatura(idSensor, sensorKey,hora):
    #threading.Timer(5.0, insertarTemperatura(sensorKey)).start()
    URL_Cruda="http://192.168.0.3/servidor/conexiones/insert.php"

    valor = 37.0
    suma = random.randint(0, 40)
    suma= suma - 20
    suma= suma/10
    valor = valor+suma
    firma = sensorKey+hora
    encript = (hashlib.md5(firma.encode())).hexdigest()
    URL="http://192.168.0.3/servidor/conexiones/insert.php?idSensor="+(str(idSensor))+"&certificado="+(str(encript))+"&valor="+(str(valor))+"&hora="+(str(hora))
    print (URL)
    r = requests.get(url = URL, params="")
    r.raise_for_status()
    print ("vuelta")

def insertarRespiracion(idSensor, sensorKey,hora):
    #threading.Timer(5.0, insertarTemperatura(sensorKey)).start()
    

    valor = (random.randint(60, 140))/2
    
    firma = sensorKey+hora
    encript = (hashlib.md5(firma.encode())).hexdigest()
    URL="http://192.168.0.3/servidor/conexiones/insert.php?idSensor="+(str(idSensor))+"&certificado="+(str(encript))+"&valor="+(str(valor))+"&hora="+(str(hora))
    print (URL)
    r = requests.get(url = URL, params="")
    r.raise_for_status()
    print ("respiracion insertada")
    
def ciclo(claves = []):
    #athreading.Timer(5.0, ciclo(claves)).start()
    now = datetime.datetime.now()
    hora = str(now.hour)+":"+str(now.minute)
    insertarPulso(2,claves[1],hora)
    insertarTemperatura(1,claves[0],hora)
    insertarRespiracion(3,claves[2],hora)
    s.enter(10, 1, ciclo, (claves,))
    
#claves = ["FFDHT11TEST", "GGHPULSOCARCTEST","HHRESPIRATEST"]
def obtieneclaves():
    mydb = mysql.connector.connect (
    host="localhost",
    user="root",
    password="password",
    database="monitorbebefirmas"
    )
    array = []
    mycursor = mydb.cursor()
    mycursor.execute("select * from sensor")
    myresult = mycursor.fetchall()
    for x in myresult:
        array.append(x[1])
        
    return array

claves = obtieneclaves()
print (claves)


s = sched.scheduler(time.time, time.sleep)
s.enter(10,1, ciclo,(claves,))
s.run()

ciclo(claves)


