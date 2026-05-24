# Fireblog Classic

一个轻量、文字优先的 WordPress 主题，用来为 [huo.me](https://huo.me) 提供接近经典独立博客的阅读体验。

这个主题重点复刻的是布局和阅读气质：深蓝灰背景、左侧窄菜单、右侧窄正文、按月归档、朴素表单和低装饰链接。主题不包含 Daring Fireball 的 logo、图片、内容或品牌资产。

## 安装

1. 下载 release 附件里的 `fireblog-classic.zip`。
2. 打开 WordPress 后台。
3. 进入「外观」->「主题」->「安装主题」->「上传主题」。
4. 上传 `fireblog-classic.zip` 并启用。
5. 如有缓存插件或 CDN，清理缓存后刷新页面。

## 归档页

主题会接管 `/archive/` 地址，显示按月份分组的文章列表，例如 `May 2026`。左侧菜单中的「归档」会自动链接到这个页面。

也可以在 WordPress 后台创建一个 slug 为 `archive` 的页面，或手动选择 `Fireblog Monthly Archive` 模板。

## 菜单与作者

主题会在左侧菜单第一项自动插入「归档」。其他菜单项可以在 WordPress 后台的 `Sidebar Menu` 菜单位置里配置。

作者默认显示为 `happy xiao`，链接到 `https://aa.ee`。如果需要修改，可以在 Customizer 的 `Fireblog Options` 中调整。

## Logo

主题支持 WordPress 自定义 logo。当前样式会把 logo 控制为较小尺寸，并在右侧显示站点标题。

---

# Fireblog Classic

A lightweight, text-first WordPress theme for [huo.me](https://huo.me), inspired by the reading feel of classic independent weblogs.

The theme focuses on layout and reading atmosphere: dark blue-gray background, narrow left navigation, narrow main column, monthly archives, plain form controls, and restrained links. It does not include Daring Fireball logos, images, content, or brand assets.

## Installation

1. Download `fireblog-classic.zip` from the release assets.
2. Open the WordPress admin dashboard.
3. Go to Appearance -> Themes -> Add New -> Upload Theme.
4. Upload `fireblog-classic.zip` and activate it.
5. Clear any WordPress cache plugin or CDN cache if needed.

## Archive Page

The theme handles `/archive/` directly and renders all published posts grouped by month, such as `May 2026`. The sidebar automatically prepends a `归档` link to this page.

You can also create a WordPress page with the slug `archive`, or manually select the `Fireblog Monthly Archive` template.

## Menu And Author

The sidebar menu automatically prepends the archive link. Other links can be configured by assigning a menu to the `Sidebar Menu` location.

The default author line is `happy xiao`, linked to `https://aa.ee`. It can be changed in the Customizer under `Fireblog Options`.

## Logo

The theme supports the standard WordPress custom logo. The current style keeps the logo compact and displays the site title beside it.
