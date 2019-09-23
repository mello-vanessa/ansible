You should create a ssh-key to your user before execute the playbook: 
ssh-keygen -t rsa -b 2048
This user should be the same username at local and remote host.

1. To create a new user in remote host, with sudoers privileges and disable ssh root login on server andssh password auth:
Replace:
$user to new user
$password to new user´s password
$userRemoteHost = user to connect to remote host
$passwordRemoteHost = user´s password to connect to remote host

ansible-playbook -i hosts addUser.yml --extra-vars "USER=$user PASSWORD=$password ansible_user=$userRemoteHost ansible_password=$passwordRemoteHost"

2. To Configure nginx server and new domain:
Replace:
$servername to new server name
$domain to new domain

ansible-playbook -i hosts production.yml --extra-vars "HOSTNAME=$serverName DOMAIN=$domain"
