## Init env
> copy .env.example to .env

## Make on mac os ssl certificates
```
cd ./certs
mkcert sso.test "*.sso.test"
mkcert sso-client-1.test "*.sso-client-1.test"
mkcert sso-client-2.test "*.sso-client-2.test"
``` 

## hosts file
> /etc/hosts
```
127.0.0.1       sso.test sso-client-1.test sso-client-2.test mailhog.test
```

## RUN docker
```
docker-compose up -d
```