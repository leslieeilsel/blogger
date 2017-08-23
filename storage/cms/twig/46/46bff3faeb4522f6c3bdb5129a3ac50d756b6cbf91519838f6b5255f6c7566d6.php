<?php

/* D:\phpStudy\WWW\blogger/themes/responsiv-clean/partials/site/sidebar.htm */
class __TwigTemplate_af933c1f4ef3bf1f1d915f9de961fb2676cc17691ccc899a07785aee47996123 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"sidebar-close visible-sm visible-xs\">
    <a href=\"javascript:;\" onclick=\"toggleSidebar()\" class=\"close\">&times;</a>
</div>

<div class=\"sidebar-segment hidden-sm hidden-xs\">
    <h1 class=\"site-name\">
        <a href=\"";
        // line 7
        echo $this->env->getExtension('Cms\Twig\Extension')->pageFilter("home");
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["this"] ?? null), "theme", array()), "site_name", array()), "html", null, true);
        echo "</a>
    </h1>
    <p class=\"site-motto\">
        ";
        // line 10
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["this"] ?? null), "theme", array()), "site_motto", array()), "html", null, true);
        echo "
    </p>
</div>

<div class=\"sidebar-segment\">
    <h2 class=\"segment-title\">最近的帖子</h2>
    <ul class=\"segment-list\">
        ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["blogPosts"] ?? null), "posts", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 18
            echo "            <li><a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "url", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["post"], "title", array()), "html", null, true);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "    </ul>
</div>

<div class=\"sidebar-segment\">
    <h2 class=\"segment-title\">标签</h2>
    <ul class=\"segment-list\">
            ";
        // line 26
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('CMS')->componentFunction("blogCategories"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 27
        echo "        <!-- ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["blogCategories"] ?? null), "categories", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 28
            echo "            <li><a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "url", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "title", array()), "html", null, true);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo " -->
    </ul>
</div>

<div class=\"sidebar-segment\">
    <h2 class=\"segment-title\">Follow me</h2>
    <ul class=\"segment-list\">
        <li><img src=\"/themes/responsiv-clean/assets/images/sina.png\" alt=\"\" width=\"20px\">&nbsp;&nbsp;<a href=\"javascript:volid(0)\" target=\"_blank\">微博 : @leslie-eilsel</a></li>
        <li><img src=\"/themes/responsiv-clean/assets/images/wechat.svg\" alt=\"\" width=\"16px\">&nbsp;&nbsp;<a href=\"javascript:volid(0)\" target=\"_blank\">微信 : liuxing729320</a></li>
        <li><img src=\"/themes/responsiv-clean/assets/images/gmail.svg\" alt=\"\" width=\"15px\">&nbsp;&nbsp;<a href=\"javascript:volid(0)\">Email : leslieliuxing@gmail.com</a></li>
    </ul>
</div>";
    }

    public function getTemplateName()
    {
        return "D:\\phpStudy\\WWW\\blogger/themes/responsiv-clean/partials/site/sidebar.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 29,  77 => 28,  72 => 27,  68 => 26,  60 => 20,  49 => 18,  45 => 17,  35 => 10,  27 => 7,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"sidebar-close visible-sm visible-xs\">
    <a href=\"javascript:;\" onclick=\"toggleSidebar()\" class=\"close\">&times;</a>
</div>

<div class=\"sidebar-segment hidden-sm hidden-xs\">
    <h1 class=\"site-name\">
        <a href=\"{{ 'home'|page }}\">{{ this.theme.site_name }}</a>
    </h1>
    <p class=\"site-motto\">
        {{ this.theme.site_motto }}
    </p>
</div>

<div class=\"sidebar-segment\">
    <h2 class=\"segment-title\">最近的帖子</h2>
    <ul class=\"segment-list\">
        {% for post in blogPosts.posts %}
            <li><a href=\"{{ post.url }}\">{{ post.title }}</a></li>
        {% endfor %}
    </ul>
</div>

<div class=\"sidebar-segment\">
    <h2 class=\"segment-title\">标签</h2>
    <ul class=\"segment-list\">
            {% component 'blogCategories' %}
        <!-- {% for category in blogCategories.categories %}
            <li><a href=\"{{ category.url }}\">{{ category.title }}</a></li>
        {% endfor %} -->
    </ul>
</div>

<div class=\"sidebar-segment\">
    <h2 class=\"segment-title\">Follow me</h2>
    <ul class=\"segment-list\">
        <li><img src=\"/themes/responsiv-clean/assets/images/sina.png\" alt=\"\" width=\"20px\">&nbsp;&nbsp;<a href=\"javascript:volid(0)\" target=\"_blank\">微博 : @leslie-eilsel</a></li>
        <li><img src=\"/themes/responsiv-clean/assets/images/wechat.svg\" alt=\"\" width=\"16px\">&nbsp;&nbsp;<a href=\"javascript:volid(0)\" target=\"_blank\">微信 : liuxing729320</a></li>
        <li><img src=\"/themes/responsiv-clean/assets/images/gmail.svg\" alt=\"\" width=\"15px\">&nbsp;&nbsp;<a href=\"javascript:volid(0)\">Email : leslieliuxing@gmail.com</a></li>
    </ul>
</div>", "D:\\phpStudy\\WWW\\blogger/themes/responsiv-clean/partials/site/sidebar.htm", "");
    }
}
