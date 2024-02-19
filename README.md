Arranque local con docker

- Edita el archivo hosts y añade:
> **Windows**: C:\Windows\System32\drivers\etc\hosts
**Linux y Mac**: /etc/hosts

```text
127.0.0.1 idealista.local
```

- Clonar el siguiente proyecto back

```shell
git clone https://github.com/Moyano07/back-idealista.git
```
- Ejecuta este comando para construir los contenedores :

```shell
docker-compose -f docker-compose.yml build --no-cache
```
- Levanta los contenedores:
```shell
docker-compose -f docker-compose.yml up -d
```
Instalar dependencias de composer:
```shell
docker exec -it idealista_php composer install
```
Podemos ejecutar una terminal dentro del contenedor de PHP para lanzar cualquier comando que necesitamos:
```shell
docker exec -it idealista_php bash
```
Listo, ya deberías poder realizar peticiones a [http://idealista.local]

 
