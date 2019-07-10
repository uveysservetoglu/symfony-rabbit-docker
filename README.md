Docker - RabbitMQ - Symfony 4.3
==========

Açıklama
-----
Örnek bir RabbitMQ Docker ve PHP uygulamasıdır.

Amaç
------

Kullanıcılar eklemek istedikleri ürünleri RabbitMQ ile sıraya koyar. 
Ve bu ürün kuyruğunu Rabbit MQ ile MySQL database product tablosuna sırayla ekler.



Aşağıdaki kurulum adımlarını takip ederek, projeyi çalıştırın. 


Docker Build
-----
```bash
 docker build -t symfony-docker ./
```

Bir docker image oluşturduk. 

docker-compose.yml ile rabbitmq mysql ve php çalıştırıyoruz. 


```bash
 docker-compose up -d
```


Projenin Çalıştırılması
-----

```bash
composer install
```


Öncellikle 'ecommerce' adında bir database yaratmalıyız.

```bash
 php bin/console doctrine:database:create
```

Aşağıdaki kod ile tabloları oluşturabilirsiniz.

```bash
 php bin/console doctrine:schema:update --force
```

Proje içinde migration dosyaları da mevcuttur. Aşağıdaki komutu da tablolar için kullanabilirsiniz.

```bash
 php bin/console doctrine:migrations:migrate
```


Product ekleme sırasında consumerlar işlemesi için aşağıdaki kodu çalıştırmanız gerekmektedir.


```bash
 php bin/console rabbitmq:consumer product
```

Aşağıdaki komut ile fake datalar veri tabanına aktarılır

```bash
php bin/console doctrine:fixtures:load
```

Aşağıdaki komut ile rabbit üzerinden fake datalar veri tabanına aktarılır

```bash
 php bin/console app:test-rabbit
```

