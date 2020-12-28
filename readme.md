## Laravel Orion Sample App

```bash
git clone https://github.com/tailflow/laravel-orion-sample-app.git

cd laravel-orion-sample-app

composer install

mv .env.example .env
```


### make sure you change .env variable accordingly

```bash
php artisan key:generate

php artisan migrate

php artisan passport:install
```

### if you want to use Personal Access Tokens make sure you update .env from php artisan passport:install result

```bash
PASSPORT_PERSONAL_ACCESS_CLIENT_ID="1"
PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET="randomhashcode"
```


### Available Routes

```bash
php artisan route:list --column=method,uri,name
```

| Method    | URI                                             | Name                              |
|-----------|-------------------------------------------------|-----------------------------------|
| GET       | /                                               |                                   |
| DELETE    | api/post_metas/{post_meta}/post/batch           | api.post_metas.post.batchDestroy  |
| PATCH     | api/post_metas/{post_meta}/post/batch           | api.post_metas.post.batchUpdate   |
| DELETE    | api/post_metas/{post_meta}/post/{post?}         | api.post_metas.post.destroy       |
| PUT/PATCH | api/post_metas/{post_meta}/post/{post?}         | api.post_metas.post.update        |
| GET       | api/post_metas/{post_meta}/post/{post?}         | api.post_metas.post.show          |
| GET       | api/posts                                       | api.posts.index                   |
| POST      | api/posts                                       | api.posts.store                   |
| PATCH     | api/posts/batch                                 | api.posts.batchUpdate             |
| POST      | api/posts/batch                                 | api.posts.batchStore              |
| DELETE    | api/posts/batch                                 | api.posts.batchDestroy            |
| POST      | api/posts/batch/restore                         | api.posts.batchRestore            |
| POST      | api/posts/search                                | api.posts.search                  |
| GET       | api/posts/{post}                                | api.posts.show                    |
| PUT/PATCH | api/posts/{post}                                | api.posts.update                  |
| DELETE    | api/posts/{post}                                | api.posts.destroy                 |
| GET       | api/posts/{post}/comments                       | api.posts.comments.index          |
| POST      | api/posts/{post}/comments                       | api.posts.comments.store          |
| POST      | api/posts/{post}/comments/associate             | api.posts.comments.associate      |
| DELETE    | api/posts/{post}/comments/batch                 | api.posts.comments.batchDestroy   |
| PATCH     | api/posts/{post}/comments/batch                 | api.posts.comments.batchUpdate    |
| POST      | api/posts/{post}/comments/batch                 | api.posts.comments.batchStore     |
| POST      | api/posts/{post}/comments/search                | api.posts.comments.search         |
| PUT/PATCH | api/posts/{post}/comments/{comment?}            | api.posts.comments.update         |
| GET       | api/posts/{post}/comments/{comment?}            | api.posts.comments.show           |
| DELETE    | api/posts/{post}/comments/{comment?}            | api.posts.comments.destroy        |
| DELETE    | api/posts/{post}/comments/{comment?}/dissociate | api.posts.comments.dissociate     |
| POST      | api/posts/{post}/image                          | api.posts.image.store             |
| DELETE    | api/posts/{post}/image/batch                    | api.posts.image.batchDestroy      |
| PATCH     | api/posts/{post}/image/batch                    | api.posts.image.batchUpdate       |
| POST      | api/posts/{post}/image/batch                    | api.posts.image.batchStore        |
| GET       | api/posts/{post}/image/{image?}                 | api.posts.image.show              |
| PUT/PATCH | api/posts/{post}/image/{image?}                 | api.posts.image.update            |
| DELETE    | api/posts/{post}/image/{image?}                 | api.posts.image.destroy           |
| POST      | api/posts/{post}/meta                           | api.posts.meta.store              |
| PATCH     | api/posts/{post}/meta/batch                     | api.posts.meta.batchUpdate        |
| DELETE    | api/posts/{post}/meta/batch                     | api.posts.meta.batchDestroy       |
| POST      | api/posts/{post}/meta/batch                     | api.posts.meta.batchStore         |
| PUT/PATCH | api/posts/{post}/meta/{metum?}                  | api.posts.meta.update             |
| DELETE    | api/posts/{post}/meta/{metum?}                  | api.posts.meta.destroy            |
| GET       | api/posts/{post}/meta/{metum?}                  | api.posts.meta.show               |
| POST      | api/posts/{post}/restore                        | api.posts.restore                 |
| POST      | api/posts/{post}/tags                           | api.posts.tags.store              |
| GET       | api/posts/{post}/tags                           | api.posts.tags.index              |
| POST      | api/posts/{post}/tags/attach                    | api.posts.tags.attach             |
| DELETE    | api/posts/{post}/tags/batch                     | api.posts.tags.batchDestroy       |
| POST      | api/posts/{post}/tags/batch                     | api.posts.tags.batchStore         |
| PATCH     | api/posts/{post}/tags/batch                     | api.posts.tags.batchUpdate        |
| DELETE    | api/posts/{post}/tags/detach                    | api.posts.tags.detach             |
| POST      | api/posts/{post}/tags/search                    | api.posts.tags.search             |
| PATCH     | api/posts/{post}/tags/sync                      | api.posts.tags.sync               |
| PATCH     | api/posts/{post}/tags/toggle                    | api.posts.tags.toggle             |
| GET       | api/posts/{post}/tags/{tag?}                    | api.posts.tags.show               |
| DELETE    | api/posts/{post}/tags/{tag?}                    | api.posts.tags.destroy            |
| PUT/PATCH | api/posts/{post}/tags/{tag?}                    | api.posts.tags.update             |
| PATCH     | api/posts/{post}/tags/{tag?}/pivot              | api.posts.tags.updatePivot        |
| DELETE    | api/posts/{post}/user/batch                     | api.posts.user.batchDestroy       |
| PATCH     | api/posts/{post}/user/batch                     | api.posts.user.batchUpdate        |
| DELETE    | api/posts/{post}/user/{user?}                   | api.posts.user.destroy            |
| GET       | api/posts/{post}/user/{user?}                   | api.posts.user.show               |
| PUT/PATCH | api/posts/{post}/user/{user?}                   | api.posts.user.update             |
| POST      | api/roles                                       | api.roles.store                   |
| GET       | api/roles                                       | api.roles.index                   |
| DELETE    | api/roles/batch                                 | api.roles.batchDestroy            |
| PATCH     | api/roles/batch                                 | api.roles.batchUpdate             |
| POST      | api/roles/batch                                 | api.roles.batchStore              |
| POST      | api/roles/search                                | api.roles.search                  |
| DELETE    | api/roles/{role}                                | api.roles.destroy                 |
| PUT/PATCH | api/roles/{role}                                | api.roles.update                  |
| GET       | api/roles/{role}                                | api.roles.show                    |
| GET       | api/tags/{tag}/posts                            | api.tags.posts.index              |
| POST      | api/tags/{tag}/posts                            | api.tags.posts.store              |
| POST      | api/tags/{tag}/posts/attach                     | api.tags.posts.attach             |
| POST      | api/tags/{tag}/posts/batch                      | api.tags.posts.batchStore         |
| PATCH     | api/tags/{tag}/posts/batch                      | api.tags.posts.batchUpdate        |
| DELETE    | api/tags/{tag}/posts/batch                      | api.tags.posts.batchDestroy       |
| DELETE    | api/tags/{tag}/posts/detach                     | api.tags.posts.detach             |
| POST      | api/tags/{tag}/posts/search                     | api.tags.posts.search             |
| PATCH     | api/tags/{tag}/posts/sync                       | api.tags.posts.sync               |
| PATCH     | api/tags/{tag}/posts/toggle                     | api.tags.posts.toggle             |
| GET       | api/tags/{tag}/posts/{post?}                    | api.tags.posts.show               |
| PUT/PATCH | api/tags/{tag}/posts/{post?}                    | api.tags.posts.update             |
| DELETE    | api/tags/{tag}/posts/{post?}                    | api.tags.posts.destroy            |
| PATCH     | api/tags/{tag}/posts/{post?}/pivot              | api.tags.posts.updatePivot        |
| POST      | api/teams/{team}/posts                          | api.teams.posts.store             |
| GET       | api/teams/{team}/posts                          | api.teams.posts.index             |
| POST      | api/teams/{team}/posts/associate                | api.teams.posts.associate         |
| POST      | api/teams/{team}/posts/batch                    | api.teams.posts.batchStore        |
| PATCH     | api/teams/{team}/posts/batch                    | api.teams.posts.batchUpdate       |
| DELETE    | api/teams/{team}/posts/batch                    | api.teams.posts.batchDestroy      |
| POST      | api/teams/{team}/posts/search                   | api.teams.posts.search            |
| DELETE    | api/teams/{team}/posts/{post?}                  | api.teams.posts.destroy           |
| GET       | api/teams/{team}/posts/{post?}                  | api.teams.posts.show              |
| PUT/PATCH | api/teams/{team}/posts/{post?}                  | api.teams.posts.update            |
| DELETE    | api/teams/{team}/posts/{post?}/dissociate       | api.teams.posts.dissociate        |
| GET       | api/user                                        |                                   |
| POST      | api/users/{user}/posts                          | api.users.posts.store             |
| GET       | api/users/{user}/posts                          | api.users.posts.index             |
| POST      | api/users/{user}/posts/associate                | api.users.posts.associate         |
| PATCH     | api/users/{user}/posts/batch                    | api.users.posts.batchUpdate       |
| DELETE    | api/users/{user}/posts/batch                    | api.users.posts.batchDestroy      |
| POST      | api/users/{user}/posts/batch                    | api.users.posts.batchStore        |
| POST      | api/users/{user}/posts/batch/restore            | api.users.posts.batchRestore      |
| POST      | api/users/{user}/posts/search                   | api.users.posts.search            |
| DELETE    | api/users/{user}/posts/{post?}                  | api.users.posts.destroy           |
| PUT/PATCH | api/users/{user}/posts/{post?}                  | api.users.posts.update            |
| GET       | api/users/{user}/posts/{post?}                  | api.users.posts.show              |
| DELETE    | api/users/{user}/posts/{post?}/dissociate       | api.users.posts.dissociate        |
| POST      | api/users/{user}/posts/{post?}/restore          | api.users.posts.restore           |
| POST      | api/users/{user}/roles                          | api.users.roles.store             |
| GET       | api/users/{user}/roles                          | api.users.roles.index             |
| POST      | api/users/{user}/roles/attach                   | api.users.roles.attach            |
| DELETE    | api/users/{user}/roles/batch                    | api.users.roles.batchDestroy      |
| PATCH     | api/users/{user}/roles/batch                    | api.users.roles.batchUpdate       |
| POST      | api/users/{user}/roles/batch                    | api.users.roles.batchStore        |
| DELETE    | api/users/{user}/roles/detach                   | api.users.roles.detach            |
| POST      | api/users/{user}/roles/search                   | api.users.roles.search            |
| PATCH     | api/users/{user}/roles/sync                     | api.users.roles.sync              |
| PATCH     | api/users/{user}/roles/toggle                   | api.users.roles.toggle            |
| GET       | api/users/{user}/roles/{role?}                  | api.users.roles.show              |
| PUT/PATCH | api/users/{user}/roles/{role?}                  | api.users.roles.update            |
| DELETE    | api/users/{user}/roles/{role?}                  | api.users.roles.destroy           |
| PATCH     | api/users/{user}/roles/{role?}/pivot            | api.users.roles.updatePivot       |
| GET       | oauth/authorize                                 | passport.authorizations.authorize |
| DELETE    | oauth/authorize                                 | passport.authorizations.deny      |
| POST      | oauth/authorize                                 | passport.authorizations.approve   |
| POST      | oauth/clients                                   | passport.clients.store            |
| GET       | oauth/clients                                   | passport.clients.index            |
| DELETE    | oauth/clients/{client_id}                       | passport.clients.destroy          |
| PUT       | oauth/clients/{client_id}                       | passport.clients.update           |
| POST      | oauth/personal-access-tokens                    | passport.personal.tokens.store    |
| GET       | oauth/personal-access-tokens                    | passport.personal.tokens.index    |
| DELETE    | oauth/personal-access-tokens/{token_id}         | passport.personal.tokens.destroy  |
| GET       | oauth/scopes                                    | passport.scopes.index             |
| POST      | oauth/token                                     | passport.token                    |
| POST      | oauth/token/refresh                             | passport.token.refresh            |
| GET       | oauth/tokens                                    | passport.tokens.index             |
| DELETE    | oauth/tokens/{token_id}                         | passport.tokens.destroy           |