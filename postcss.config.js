const sortCssMediaQueries = require( 'sort-css-media-queries/index.js' );

module.exports = {
  plugins: [
    [
      // 重複するセレクタをまとめる
      'postcss-combine-duplicated-selectors',
      {
        removeDuplicatedProperties: true,
      },
    ],
    [
      // 重複するメディアクエリをまとめる
      '@lipemat/css-mqpacker',
      {
        // メディアクエリをソート
        sort: sortCssMediaQueries,
      },
    ],
    [
      'css-declaration-sorter',
      {
        // CSSの属性をソート
        order: 'smacss',
      },
    ],
    [
      // ベンダープレフィックスを付与
      'autoprefixer',
      {
        // CSSグリッドを使う
        grid: true,
      },
    ],
  ],
};
