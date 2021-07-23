# ScanManager

```
composer require hyperf/scan-manager-incubator
```

## 如何在 Hyperf v2.2 版本及以上使用 Swoole Compiler

`Hyperf` 项目线上运行时，务必开启 `SCAN_CACHEABLE`，这样在项目启动时，只要缓存存在时，就不会再次扫描注解。

所以，在我们要加密代码时，务必按照以下步骤进行：

1. 开启 `SCAN_CACHEABLE`
2. 执行 `composer dump-autoload -o` 优化索引的同时删除 `runtime/container` 目录
3. 执行 `php bin/hyperf.php scan:cache` 生成 `runtime/container`
4. 打包代码后进行加密，需要注意以下问题：
5. 设置加密文件黑名单，不加密vendor、test、config等文件夹
6. 选择保留注释
7. 安装好扩展后即可正常运行代码
