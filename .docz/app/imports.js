export const imports = {
  'docs/index.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-index" */ 'docs/index.md'
    ),
  'docs/models/attachment.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-models-attachment" */ 'docs/models/attachment.md'
    ),
  'docs/models/basemodel.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-models-basemodel" */ 'docs/models/basemodel.md'
    ),
  'docs/models/comment.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-models-comment" */ 'docs/models/comment.md'
    ),
  'docs/models/links.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-models-links" */ 'docs/models/links.md'
    ),
  'docs/models/option.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-models-option" */ 'docs/models/option.md'
    ),
  'docs/models/post.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-models-post" */ 'docs/models/post.md'
    ),
  'docs/models/term.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-models-term" */ 'docs/models/term.md'
    ),
  'docs/models/user.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-models-user" */ 'docs/models/user.md'
    ),
  'docs/providers/databaseserviceprovider.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-providers-databaseserviceprovider" */ 'docs/providers/databaseserviceprovider.md'
    ),
  'docs/console/commands/migrate/basecommand.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-console-commands-migrate-basecommand" */ 'docs/console/commands/migrate/basecommand.md'
    ),
  'docs/console/commands/migrate/installcommand.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-console-commands-migrate-installcommand" */ 'docs/console/commands/migrate/installcommand.md'
    ),
  'docs/console/commands/migrate/makecommand.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-console-commands-migrate-makecommand" */ 'docs/console/commands/migrate/makecommand.md'
    ),
  'docs/console/commands/migrate/migratecommand.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-console-commands-migrate-migratecommand" */ 'docs/console/commands/migrate/migratecommand.md'
    ),
  'docs/console/commands/migrate/refreshcommand.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-console-commands-migrate-refreshcommand" */ 'docs/console/commands/migrate/refreshcommand.md'
    ),
  'docs/console/commands/migrate/resetcommand.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-console-commands-migrate-resetcommand" */ 'docs/console/commands/migrate/resetcommand.md'
    ),
  'docs/console/commands/migrate/rollbackcommand.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-console-commands-migrate-rollbackcommand" */ 'docs/console/commands/migrate/rollbackcommand.md'
    ),
  'docs/console/commands/migrate/statuscommand.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-console-commands-migrate-statuscommand" */ 'docs/console/commands/migrate/statuscommand.md'
    ),
  'docs/console/commands/seeds/seedcommand.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-console-commands-seeds-seedcommand" */ 'docs/console/commands/seeds/seedcommand.md'
    ),
  'docs/console/commands/seeds/seedermakecommand.md': () =>
    import(
      /* webpackPrefetch: true, webpackChunkName: "docs-console-commands-seeds-seedermakecommand" */ 'docs/console/commands/seeds/seedermakecommand.md'
    ),
}
