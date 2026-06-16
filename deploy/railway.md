# Deploy روی Railway

1. پروژه را روی GitHub push کن.
2. در Railway یک Project جدید بساز.
3. Repo را وصل کن.
4. Variables را از `.env.example` بساز.
5. دیتابیس PostgreSQL یا MySQL اضافه کن.
6. build command:

```bash
npm run build
```

7. pre-deploy command:

```bash
php artisan migrate --force && php artisan optimize
```
