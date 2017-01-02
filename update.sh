git add -A;
#git commit -m $(date +%Y%m%d);
#git push -u origin master;
read -p "此次上传:"  val
##echo $val
git commit -m $val
#git push all --all
git push origin master -f
#ssh -p 22 root@123.56.154.87 'cd /var/www/html/RollerPHP_framework && git pull origin master';  
