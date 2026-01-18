module.exports = {
  content: ["source/**/*.blade.php", "source/**/*.md", "source/**/*.html"],
  theme: {
    extend: {
      colors: {
        bg: "var(--bg)",
        text: "var(--text)",
        link: "var(--link)",
        "link-hover": "var(--link-hover)",
      },
      fontFamily: {
        body: "var(--font-body)",
        heading: "var(--font-heading)",
      },
    },
  },
};
