<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project - Authentication</h1>
    <br>
</p>

Instruções:

Username: superadmin

Password: pai@comp2019


# Como rodar

Crie um volume para a base de dados

```bash
docker volume create pai_database
```

Rodar para o app e as migrations
```bash
docker compose up
```

Rodas para desenvolvimento

```bash
docker compose -f docker-compose.yml -f docker-compose.dev.yml up
```