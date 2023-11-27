import webbrowser as wb
import schedule
import time
import os


def sync():
    wb.open('http://127.0.0.1:8080/sync')


def close():
    os.system("taskkill /im chrome.exe /f")


schedule.every().day.at("04:00").do(sync)
schedule.every().day.at("04:05").do(close)
schedule.every().day.at("12:30").do(sync)
schedule.every().day.at("12:35").do(close)
schedule.every().day.at("20:00").do(sync)
schedule.every().day.at("20:05").do(close)

while 1:
    schedule.run_pending()
    time.sleep(1)
