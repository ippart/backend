build: composer
	@mkdir $(CURDIR)/$@
	@cp -r $(CURDIR)/vendor/opencart/opencart/upload/* $(CURDIR)/$@/
	@rm -rf $(CURDIR)/$@/install
	@rm -rf $(CURDIR)/$@/catalog/view
	@cp -r $(CURDIR)/view $(CURDIR)/$@/catalog/
	@rm -rf $(CURDIR)/$@/catalog/controller
	@cp -r $(CURDIR)/controller $(CURDIR)/$@/catalog/
	@cp -r $(CURDIR)/js $(CURDIR)/$@/
	@cp -r $(CURDIR)/css $(CURDIR)/$@/
	@cp $(CURDIR)/config/admin/config.php $(CURDIR)/$@/admin/config.php
	@cp $(CURDIR)/config/config.php $(CURDIR)/$@/config.php
	@chmod 0755 $(CURDIR)/$@/system/storage/cache/
	@chmod 0755 $(CURDIR)/$@/system/storage/logs/
	@chmod 0755 $(CURDIR)/$@/system/storage/download/
	@chmod 0755 $(CURDIR)/$@/system/storage/upload/
	@chmod 0755 $(CURDIR)/$@/system/storage/modification/
	@chmod 0755 $(CURDIR)/$@/image/
	@chmod 0755 $(CURDIR)/$@/image/cache/
	@chmod 0755 $(CURDIR)/$@/image/catalog/
	@cp -r $(CURDIR)/vendor $(CURDIR)/$@/vendor
	@cp -r $(CURDIR)/entrypoint $(CURDIR)/$@/entrypoint
	@docker build -t ippart/backend .

composer:
	@-docker run --rm -v $(CURDIR):/data imega/composer install --ignore-platform-reqs

start:
	@docker run -d --name "ippart_db" -v $(CURDIR)/conf.d/mysql:/etc/mysql/conf.d imega/mysql
	@-docker run --rm \
		-v $(CURDIR)/sql:/sql \
		--link ippart_db:ippart_db \
		imega/mysql-client \
		mysql --host=ippart_db -e "source /sql/ippart.sql"
	@-docker run --rm \
		-v $(CURDIR)/sql:/sql \
		--link ippart_db:ippart_db \
		imega/mysql-client \
		mysql --host=ippart_db -e "source /sql/dump.sql"
	@docker pull ippart/backend
	@docker run -d \
		--name "ippart" \
		--link ippart_db:ippart_db \
		ippart/backend
	@docker run -d \
		--name "ippart_nginx" \
		--link ippart:service \
		-v $(CURDIR)/conf.d/nginx:/conf \
		--volumes-from=ippart \
		-p 8900:80 \
		nginx:alpine sh -c '/usr/sbin/nginx -g "daemon off;" -p /app -c /conf/nginx.conf'

deploy:
	@-docker rm -fv ippart_nginx ippart
	@docker pull ippart/backend
	@docker run -d \
		--name "ippart" \
		--link ippart_db:ippart_db \
		ippart/backend
	@docker run -d \
		--name "ippart_nginx" \
		--link ippart:service \
		-v $(CURDIR)/conf.d/nginx:/conf \
		--volumes-from=ippart \
		-p 8900:80 \
		nginx:alpine sh -c '/usr/sbin/nginx -g "daemon off;" -p /app -c /conf/nginx.conf'
