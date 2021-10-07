<h1 align="center">Welcome to Ecommerce Refresh 5.3.9 👋</h1>
<p>
  <img alt="Version" src="https://img.shields.io/badge/version-2-blue.svg?cacheSeconds=2592000" />
</p>

> Ecommerce website based on Symfony 5.3.9, Mysql and Twig

### ✨ [Demo](localhostUrl)

## Install

```sh
# Build containers
docker-compose up -d --build
# Install Symfony's dependencies
docker exec -ti php composer install
# Create databse
docker exec -ti php symfony console d:d:c

# Setup database
docker exec -ti php symfony console d:s:u
```

## Usage

```sh
# Start http server
docker exec -ti php symfony serve:start --no-tls
```

## Author

👤 **David Vanmak**

- Website: https://peuks.github.io/
- GitHub: [@peuks](https://github.com/peuks)
- LinkedIn: [@davidvanmak](https://linkedin.com/in/davidvanmak)

## Show your support

Give a ⭐️ if this project helped you!

---

_This README was generated with ❤️ by [readme-md-generator](https://github.com/kefranabg/readme-md-generator)_
