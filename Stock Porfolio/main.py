from flask import *
import pandas as pd
import requests
import json
from pandas.io.json import json_normalize
from pandasql import sqldf
from sqlalchemy import text
import plotly.graph_objs as go
import datetime

today = datetime.date.today()
start_date = datetime.date.today() - datetime.timedelta(days=30)

def daily_stock(stock): 
    url = "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&symbol=" + stock +"&outputsize=full&apikey=demo"
    r = requests.get(url)
    data = r.json()
    print("check")
    data = data['Time Series (Daily)']

    daily_stock = dict() 
    daily_stock['stock']= stock 
    daily_stock['open']= []
    daily_stock['closed']=[]
    daily_stock['date']=[]
    counter = 0
    for entry in data: 
        daily_stock['closed'].append(float(data[entry]['4. close']))
        daily_stock['open'].append(float(data[entry]['1. open']))
        daily_stock['date'].append(entry)

    print("daily")
    return daily_stock
#KAIHBMAXXL1EKNOY
#NDKMJZC6P4OLQBMK
def quick_quote(stock): 
    url = "https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol=" + stock + "&apikey=demo"
    r = requests.get(url)
    data = r.json()
    df = pd.DataFrame(data['Global Quote'], index=[0])
    df.rename(columns={'01. symbol': 'Ticker', '05. price': 'Price', '09. change': 'Change', '10. change percent': 'Change Percent'}, inplace=True)
    print(data)
    return df

def sma(): 
    url ="https://www.alphavantage.co/query?function=SMA&symbol=IBM&interval=weekly&time_period=10&series_type=open&apikey=demo"
    r = requests.get(url)
    data = r.json()
    data=data['Technical Analysis: SMA']
    sma = dict() 
    sma['sma_value'] = []
    sma['date']= []
    for entry in data: 
        sma['sma_value'].append(float(data[entry]['SMA']))
        sma['date'].append(entry)

    return sma
def rsi(): 
    url ="https://www.alphavantage.co/query?function=RSI&symbol=IBM&interval=weekly&time_period=10&series_type=open&apikey=demo"
    r = requests.get(url)
    data = r.json()
    data=data['Technical Analysis: RSI']
    rsi = dict() 
    rsi['rsi_value'] = []
    rsi['date']= []
    for entry in data: 
        rsi['rsi_value'].append(float(data[entry]['RSI']))
        rsi['date'].append(entry)

    return rsi

stocks={"IBM"}
#stocks= {"CPX.TO", "PPL.TO", "RIOT", "RIVN", "TSLA", "XEI.TO", "CDZ.TO"}

data=[]
for index,stock in enumerate(stocks): 
    general_info = quick_quote(stock)
    ticker = stock
    stock = dict()
    stock["ticker"]= general_info["Ticker"][0]
    stock["price"] = general_info["Price"][0]
    stock["change"] =general_info["Change"][0]
    stock["change%"] = general_info["Change Percent"][0]
    
    # graph 1 
    daily_stock_data = daily_stock(ticker)
    trace = go.Scatter(x=daily_stock_data['date'], y=daily_stock_data['closed'], mode='lines+markers', name='Close')
    
    layout = go.Layout(title=None, xaxis=dict(title='Date'), yaxis=dict(title='Price'))
    fig = go.Figure(data=[trace], layout=layout)
    
    fig.add_scatter(x = daily_stock_data['date'], y=daily_stock_data['open'], mode='lines+markers', name='Open')
    fig.update_layout(width=500, height= 300,margin=dict(l=20, r=20, t=20, b=20, pad=1), xaxis_range=[start_date.strftime('%Y-%m-%d'),today.strftime('%Y-%m-%d')]) 
    filtered_data = [y for x, y in zip(trace.x, trace.y) if start_date.strftime('%Y-%m-%d') <= x <= today.strftime('%Y-%m-%d')]
    ymin = min(filtered_data)
    ymax = max(filtered_data)
    fig.update_layout(yaxis_range= [ymin - 20, ymax + 20])
    stock["graph_daily"] =fig.to_html()
    data.append(stock)
    print("done")


sma_data = sma()
#print(sma_data)
#graph 2 
trace2 = go.Scatter(x=sma_data['date'], y=sma_data['sma_value'], mode='lines+markers', name='sma')
layout2 = go.Layout(title='Simple Moving Average', xaxis=dict(title='Date'), yaxis=dict(title='Moving Average'))
fig2 = go.Figure(data=[trace2], layout=layout2)
fig2.update_layout(xaxis_range=['2023-01-01',today.strftime('%Y-%m-%d')])
#graph 3 
rsi_data= rsi()
trace3 = go.Scatter(x=rsi_data['date'], y=rsi_data['rsi_value'], mode='lines+markers', name='rsi')
layout3 = go.Layout(title='Relative Strength Index', xaxis=dict(title='Date'), yaxis=dict(title='Strength'))
fig3 = go.Figure(data=[trace3], layout=layout3)
fig3.update_layout(xaxis_range=['2023-01-01',today.strftime('%Y-%m-%d')])
fig3.add_hline( y=30, line_dash="dash", line_color="red", name='Oversold')
fig3.add_hline(y=70, line_dash="dash", line_color="green" , name='Overbought')

for stock in data: 
    print(stock)

#starts web application
app = Flask(__name__)
@app.route("/")
def home():
    return render_template("home.html", data=data, plot2 = fig2.to_html(), plot3=fig3.to_html())
    
if __name__ == "__main__":
    app.run(debug=True)
    

#plot2 = fig2.to_html(), plot3=fig3.to_html()