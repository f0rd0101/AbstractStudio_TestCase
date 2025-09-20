


# Тестове завдання

## 1. Клонування репозиторія та перехід у директорію проєкту
	git clone https://github.com/f0rd0101/AbstractStudio_TestCase.git
	cd AbstractStudio_TestCase



## 2. Встановлення залежностей
	(Backend)
	composer install

	(Frontend)
        cd frontend 
        npm i 
        cd ..

## 3. Налаштування файлу .env
Створіть файл .env на основі .env.example. Для цього введіть команду
          cp .env.example .env 

## Приклад налаштувань для підключення до бази даних:
		DB_CONNECTION=mysql
		DB_HOST=127.0.0.1
		DB_PORT=3306
		DB_DATABASE=test_db
		DB_USERNAME=root
		DB_PASSWORD=secret

## 4. Виконання міграцій
	php artisan migrate:fresh

## 5. Запуск серверів. 

	(Backend) 
	php artisan serve

	(Frontend)
	Відкрийте другий термінал,прокладіть шлях до папки frontend.Для підняття фронтенд серверу введіть команду  
		npm run dev

⚠️ВАЖЛИВЕ ЗАУВАЖЕННЯ! 
Тестування додатку потрібно проводити саме за адресою фронтенду.
		
 


