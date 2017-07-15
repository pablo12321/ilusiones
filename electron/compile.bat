@echo off
cd "C:\xampp\htdocs\electron"
electron-packager ./ Ilusiones --icon=ilusiones.ico --electron-version=1.6.11 --out="C:\Program Files\ilusiones" --overwrite
