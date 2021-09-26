# laravel-microservice

Este repositório representa a resolução dos desafios relacionados ao módulo **Microserivços: Catálogo de vídeos com Laravel (Back-end)** do treinamento FullCycle da [Code.education](https://code.education).

> As palavras-chave "DEVE", "NÃO DEVE", "REQUER", "DEVERIA", "NÃO DEVERIA", "PODERIA", "NÃO PODERIA", "RECOMENDÁVEL", "PODE", e "OPCIONAL" neste documento devem ser interpretadas como descritas no [RFC 2119](http://tools.ietf.org/html/rfc2119). Tradução livre [RFC 2119 pt-br](http://rfc.pt.webiwg.org/rfc2119).

## :arrow_forward: Rodando a aplicação

Suba os containeres executando:
```
docker-compose up -d
```

Abra o browser e acesse:
```
http://localhost:8080
```

Para instalar pacotes via composer ou utilizar os comandos do Artisan, acesse o container destinado a essa tarefa:
```
docker-compose exec app sh
```

## :memo: Licença

Assim como o framework Laravel o faz, este projeto também segue os principios de liberdade do software livre. Para saber mais sobre a licença de uso, leia: [MIT license](https://opensource.org/licenses/MIT).
