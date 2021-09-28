db_name='micro-videos'
db_name_test='micro-videos_test'

mysql -u root -p$MYSQL_ROOT_PASSWORD <<EOF
CREATE DATABASE IF NOT EXISTS \`$db_name\`;
CREATE DATABASE IF NOT EXISTS \`$db_name_test\`;

GRANT ALL ON \`$db_name\`.* TO '$MYSQL_USER'@'%';
GRANT ALL ON \`$db_name_test\`.* TO '$MYSQL_USER'@'%';

FLUSH PRIVILEGES;
EOF
