# Harmony Hotel – Otel Bilgi ve Yönetim Sistemi

## GİRİŞ
### Projenin Konusu:
Harmony Hotel, otel işletmelerinin yönetimini kolaylaştırmak ve optimize etmek için geliştirilmiş bir bilgi ve yönetim sistemi platformudur. Bu platform, müşteri rezervasyonlarından personel yönetimine kadar geniş bir yelpazede otel işletmeciliği süreçlerini yönetmeyi amaçlar.

### Projenin Amacı:
Harmony Hotel'in temel amacı, otel işletmelerinin günlük operasyonlarını verimli bir şekilde yürütmelerine yardımcı olmaktır. Bu sistem, kullanıcı dostu arayüzü ve kapsamlı özellikleriyle otel personellerinin müşteri rezervasyonları, oda yönetimi ve genel işleyişte daha verimli olmalarını hedefler. Aynı zamanda, admin kullanıcılarına geniş yetkilendirme ile otel yönetimini detaylı bir şekilde izleme ve analiz etme imkanı sunar.

### Proje Tanımı:
Harmony Hotel - Otel Bilgi ve Yönetim Sistemi, sadelik, kullanım kolaylığı ve veri odaklı bir yaklaşımla tasarlanmıştır. Bu platform, personel ve admin kullanıcılarına özel yetkilendirme ile farklı işlevsellikler sunar. Personel, müşteri kayıtlarını yönetebilir, rezervasyonları düzenleyebilir ve odaların durumunu güncelleyebilirken, admin kullanıcıları geniş yetkilendirme ile personel yönetimi, müşteri kayıtları, rezervasyonlar ve otel genel bilgilerine erişebilir.

Yönetim paneli, sadece genel bilgilerle sınırlı kalmaz; aynı zamanda otelin performansını anlamak için detaylı analizler sunar. Sezon bazlı rezervasyon dağılımları, ülke bazlı müşteri tercihleri, en popüler ödeme ve oda tipleri gibi veriler, grafikler ve analitik raporlarla görsel olarak sunulur. Bu analizler, otel yöneticilerine kararlarını destekleme, trendleri takip etme ve stratejik planlama yapma konusunda değerli bir yol haritası sunar.


## KULLANILAN TEKNİK VE YÖNTEMLER
PHP: Proje temel altyapısını oluşturmak için kullanılmıştır. Sunucu taraflı işlemleri yürütmek, veritabanı ile etkileşim sağlamak ve dinamik içerik oluşturmak için PHP tercih edilmiştir.

Bootstrap: Projede kullanıcı arayüzünün duyarlılık ve tasarım uyumluluğunu sağlamak için tercih edilmiştir. Mobil cihazlardan masaüstüne kadar farklı ekran boyutlarına uygun tasarım sunar.

MySQL: Veritabanı yönetimi için MySQL kullanılmıştır. Müşteri bilgileri, rezervasyonlar, oda durumları gibi verilerin depolanması ve yönetilmesi için MySQL veritabanı kullanılmıştır.

JavaScript: Kullanıcı arayüzünde interaktiflik ve dinamizmi artırmak için JavaScript kullanılmıştır. Sayfa üzerindeki etkileşimleri geliştirmek ve bazı istemci taraflı işlemleri gerçekleştirmek için tercih edilmiştir.

ECharts: Grafik ve veri görselleştirmesi için ECharts kütüphanesi kullanılmıştır. Sezon dağılımları, ülke bazlı istatistikler gibi verilerin görselleştirilmesi için bu kütüphane tercih edilmiştir.

Select2: Gelişmiş ve kullanıcı dostu seçim alanları oluşturmak için Select2 kullanılmıştır. Özellikle çeşitli seçenekler içeren alanlarda kullanıcı deneyimini artırmak için tercih edilmiştir.

SweetAlert2: Kullanıcı etkileşimlerini geliştirmek ve kullanıcıya daha hoş ve interaktif bildirimler sunmak için SweetAlert2 tercih edilmiştir.
![image](https://github.com/furkan-karapinar/Harmony_Otel_Bilgi_Sistemi/assets/159263067/ca95f4e4-b29c-41e2-8ab3-38a041da375d)



[![SB Admin 2 Preview](https://assets.startbootstrap.com/img/screenshots/themes/sb-admin-2.png)](https://startbootstrap.github.io/startbootstrap-sb-admin-2/)

**[Launch Live Preview](https://startbootstrap.github.io/startbootstrap-sb-admin-2/)**

## Status

[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/StartBootstrap/startbootstrap-sb-admin-2/master/LICENSE)
[![npm version](https://img.shields.io/npm/v/startbootstrap-sb-admin-2.svg)](https://www.npmjs.com/package/startbootstrap-sb-admin-2)
[![Build Status](https://travis-ci.org/StartBootstrap/startbootstrap-sb-admin-2.svg?branch=master)](https://travis-ci.org/StartBootstrap/startbootstrap-sb-admin-2)
[![dependencies Status](https://david-dm.org/StartBootstrap/startbootstrap-sb-admin-2/status.svg)](https://david-dm.org/StartBootstrap/startbootstrap-sb-admin-2)
[![devDependencies Status](https://david-dm.org/StartBootstrap/startbootstrap-sb-admin-2/dev-status.svg)](https://david-dm.org/StartBootstrap/startbootstrap-sb-admin-2?type=dev)

## Download and Installation

To begin using this template, choose one of the following options to get started:

* [Download the latest release on Start Bootstrap](https://startbootstrap.com/theme/sb-admin-2/)
* Install via npm: `npm i startbootstrap-sb-admin-2`
* Clone the repo: `git clone https://github.com/StartBootstrap/startbootstrap-sb-admin-2.git`
* [Fork, Clone, or Download on GitHub](https://github.com/StartBootstrap/startbootstrap-sb-admin-2)

## Usage

After installation, run `npm install` and then run `npm start` which will open up a preview of the template in your default browser, watch for changes to core template files, and live reload the browser when changes are saved. You can view the `gulpfile.js` to see which tasks are included with the dev environment.

### Gulp Tasks

* `gulp` the default task that builds everything
* `gulp watch` browserSync opens the project in your default browser and live reloads when changes are made
* `gulp css` compiles SCSS files into CSS and minifies the compiled CSS
* `gulp js` minifies the themes JS file
* `gulp vendor` copies dependencies from node_modules to the vendor directory

You must have npm installed globally in order to use this build environment. This theme was built using node v11.6.0 and the Gulp CLI v2.0.1. If Gulp is not running properly after running `npm install`, you may need to update node and/or the Gulp CLI locally.

## Bugs and Issues

Have a bug or an issue with this template? [Open a new issue](https://github.com/StartBootstrap/startbootstrap-sb-admin-2/issues) here on GitHub or leave a comment on the [template overview page at Start Bootstrap](https://startbootstrap.com/theme/sb-admin-2/).

## About

Start Bootstrap is an open source library of free Bootstrap templates and themes. All of the free templates and themes on Start Bootstrap are released under the MIT license, which means you can use them for any purpose, even for commercial projects.

* <https://startbootstrap.com>
* <https://twitter.com/SBootstrap>

Start Bootstrap was created by and is maintained by **[David Miller](https://davidmiller.io/)**.

* <https://davidmiller.io>
* <https://twitter.com/davidmillerhere>
* <https://github.com/davidtmiller>

Start Bootstrap is based on the [Bootstrap](https://getbootstrap.com/) framework created by [Mark Otto](https://twitter.com/mdo) and [Jacob Thorton](https://twitter.com/fat).

## Copyright and License

Copyright 2013-2021 Start Bootstrap LLC. Code released under the [MIT](https://github.com/StartBootstrap/startbootstrap-resume/blob/master/LICENSE) license.
