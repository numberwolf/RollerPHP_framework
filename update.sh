git add .;
git commit -m "update";
git push origin document;
ssh -p root@123.56.154.87 'cd /var/www/html/RollerDoc && git pull origin document';  