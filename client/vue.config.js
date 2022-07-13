const meta = require('./src/assets/json/meta.json');
const path = require('path');
const resolve = (dir) => path.join(__dirname, dir);

module.exports = {
  productionSourceMap: false,
  publicPath: './',
  pages: {
    index: {
      entry: 'src/main.js',
      template: 'public/index.html',
      title: meta.title,
      metaTitle: meta.metaTitle,
      metaDescription: meta.metaDescription,
    },
    sharing: {
      entry: 'src/main.js',
      template: 'public/sharing.php',
      filename: 'sharing.php',
      title: meta.title,
      metaTitle: meta.metaTitle,
      metaDescription: meta.metaDescription,
    },
  },
  chainWebpack: (config) => {
    config.module
      .rule('pug')
      .test(/\.pug$/)
      .use('pug-html-loader')
      .loader('pug-html-loader')
      .end();

    const svgRule = config.module.rule('svg');

    svgRule.uses.clear();
    svgRule
      .use('babel-loader')
      .loader('babel-loader')
      .end()
      .use('vue-svg-loader')
      .loader('vue-svg-loader');

    config.resolve.alias.set('~', resolve('client/src/assets'));
  },
  css: {
    loaderOptions: {
      scss: {
        additionalData: ` @import "@/assets/style/_variables.scss"; @import "@/assets/style/_mixins.scss";`,
      },
    },
  },
};
