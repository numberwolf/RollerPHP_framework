git add -A;
#git commit -m $(date +%Y%m%d);
#git push -u origin master;
read -p "此次上传:"  val
#echo $val
git commit -m $val
git push all --all
