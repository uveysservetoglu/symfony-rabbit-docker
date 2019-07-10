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

LİST : 
http://localhost:8000/product [GET]


CREATE : 
http://localhost:8000/product [POST]

```bash
LİST
{
	"quantity": 5,
	"price" :55.55,
	"discountPrice" : 15.55,
	"sku" : "PHONE9S",
	"name": "IPHONE 9S",
	"description" : "Test bir mesajdır. Çeviri yapılacak.sss",
	"urlKey" : "iphone_9s",
	"canonical" : "canonical etkiketi",
	"metaKeywords" : "meta_keywords, meta_keywords ,meta_keywords",
	"metaDescription" : "Test bir mesajdır. Çeviri yapılacakss."
}
```


UPDATE : 
http://localhost:8000/product/12 [PUT]

```bash
LİST
{
	"quantity": 5,
	"price" :55.55,
	"discountPrice" : 15.55,
	"sku" : "PHONE9S",
	"name": "IPHONE 9S",
	"description" : "Test bir mesajdır. Çeviri yapılacak.sss",
	"urlKey" : "iphone_9s",
	"canonical" : "canonical etkiketi",
	"metaKeywords" : "meta_keywords, meta_keywords ,meta_keywords",
	"metaDescription" : "Test bir mesajdır. Çeviri yapılacakss."
}
```

DELETE : 
http://localhost:8000/product/12 [DELETE]

Product.postman_collection.json dosyasını postman de kullanabilirsiniz.

