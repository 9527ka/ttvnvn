export default {
    install(app) {
        const requireComponent = require.context(
            '../components',  // 组件目录的相对路径
            false,            // 是否查询子目录
            /Ui-[\w-]+\.vue$/ // 匹配以 Ui- 开头的 .vue 文件
        );

        requireComponent.keys().forEach(fileName => {
            const componentConfig = requireComponent(fileName);
            const componentName = fileName.replace(/^\.\/(.*)\.\w+$/, '$1');
            app.component(componentName, componentConfig.default || componentConfig);
        });
    }
};