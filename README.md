# Ransom Art

Ransomware inspired by Hidden Tear.

Windows Forms application made in Visual Studio, written in C# (.NET Framework v4.0).

**So far I choose to have this source code private because of the security concerns. This repository is purely for showcase.**

Ransomware is set to start encrypting files from the `%USERPROFILE%` directory and only inside the `%USERPROFILE%` directory.

Only the files defined in the list below will get encrypted (modify it to your need):

```csharp
private readonly List<string> extensions = new List<string> { ".pdf", ".doc", ".docx", ".docm", ".ppt", ".pptx", ".pptm", ".xls", ".xlsx", ".xlsm", ".zip", ".7z", ".rar" };
```

All the code you need is in these two files:

* RansomArt.cs (Encryptor)
* RansomArtDecryptor.cs (Decryptor)

Ransomware will self-destruct if it:
* fails to send the encryption key to the server,
* receives unexpected or no server response,
* finishes encryption/decryption.

Ransomware was tested on Windows 10 Enterprise OS (64 bit).

API was tested on XAMPP for Windows v7.4.3 (64 bit).

Made for educational purposes. I hope it will help!

Props to [goliate/hidden-tear](https://github.com/goliate/hidden-tear); otherwise, I wouldn't know from where to start.

## How to Run

**Run this malware exclusively inside a virtual machine and with utmost care; otherwise, you risk of permanently losing your data and/or damaging your PC.**

Import ['\\db\\ransom_art.sql'](https://github.com/ivan-sincek/ransom-art/blob/master/db/ransom_art.sql) to your database server.

Copy all the content from ['\\src\\api\\'](https://github.com/ivan-sincek/ransom-art/tree/master/src/api) to your server's web root directory (e.g. to '\\xampp\\htdocs\\' on XAMPP).

Change the database settings inside ['\\src\\api\\php\\config.ini'](https://github.com/ivan-sincek/ransom-art/blob/master/src/api/php/config.ini) as necessary.

Run '\\exec\\RansomArt.exe'.

Decryption program will be created and run automaticly after the encryption phase.

**Executable provided will only work if it is run on the same localhost as the running web server.**

**Note that I didn't want to make this ransomware completely invisible nor extremely malicious, this project was just for fun.**

You can use [ngrok](https://ngrok.com/) to give your XAMPP a public address but don't forget to change and recompile the source code.

## Images

![Encryptor](https://github.com/ivan-sincek/ransom-art/blob/master/img/encryptor.jpg)

![Decryptor](https://github.com/ivan-sincek/ransom-art/blob/master/img/decryptor.jpg)

![Database](https://github.com/ivan-sincek/ransom-art/blob/master/img/db.jpg)
