const electron = require('electron')
const {app, BrowserWindow} = electron

const path = require('path')
const url = require('url')

let win

function createWindow(){
  win = new BrowserWindow({width:1024,height:768,name: "Ilusiones"})
  win.loadURL(url.format({
    pathname: path.join(__dirname,'index.html'),
    protocol: 'file',
    slashes: true
  }));
  win.maximize();

}
app.on('ready',createWindow);
app.on('window-all-closed', app.quit);
