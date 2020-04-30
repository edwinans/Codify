<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* blog/show.html.twig */
class __TwigTemplate_6718eb0b583c423a810e54bf2c32d2004a1228ee9f9291c5835a5cf5acc4649f extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "blog/show.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "blog/show.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "blog/show.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "\t<article>
\t\t<h2>";
        // line 5
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 5, $this->source); })()), "title", [], "any", false, false, false, 5), "html", null, true);
        echo "</h2>
\t\t<div class=\"metadata\">
\t\t\tEcrit le
\t\t\t";
        // line 8
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 8, $this->source); })()), "createdAt", [], "any", false, false, false, 8), "d/m/y"), "html", null, true);
        echo "
\t\t\tà
\t\t\t";
        // line 10
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 10, $this->source); })()), "createdAt", [], "any", false, false, false, 10), "H:i"), "html", null, true);
        echo "
\t\t\tdans la catégorie
\t\t\t";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 12, $this->source); })()), "category", [], "any", false, false, false, 12), "title", [], "any", false, false, false, 12), "html", null, true);
        echo "
\t\t</div>
\t\t<div class=\"content\">
\t\t\t<img src=\"";
        // line 15
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 15, $this->source); })()), "image", [], "any", false, false, false, 15), "html", null, true);
        echo " \" alt=\"\">
\t\t\t";
        // line 16
        echo twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 16, $this->source); })()), "content", [], "any", false, false, false, 16);
        echo "
\t\t</div>
\t</article>
\t<section id=\"commentaires\">
\t\t<h1>";
        // line 20
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 20, $this->source); })()), "comments", [], "any", false, false, false, 20)), "html", null, true);
        echo " commentaires </h1>  
\t";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, (isset($context["article"]) || array_key_exists("article", $context) ? $context["article"] : (function () { throw new RuntimeError('Variable "article" does not exist.', 21, $this->source); })()), "comments", [], "any", false, false, false, 21));
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 22
            echo "\t\t<div class=\"comment\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-3\">
\t\t\t\t\t";
            // line 25
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "author", [], "any", false, false, false, 25), "html", null, true);
            echo "
\t\t\t\t\t(<small>";
            // line 26
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["comment"], "createdAt", [], "any", false, false, false, 26), "d/m/Y à H:i"), "html", null, true);
            echo "</small>)
\t\t\t\t</div>
\t\t\t\t<div class=\"col\">
\t\t\t\t\t";
            // line 29
            echo twig_get_attribute($this->env, $this->source, $context["comment"], "content", [], "any", false, false, false, 29);
            echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['comment'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "\t";
        if (twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 34, $this->source); })()), "user", [], "any", false, false, false, 34)) {
            // line 35
            echo "\t\t";
            echo             $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["commentForm"]) || array_key_exists("commentForm", $context) ? $context["commentForm"] : (function () { throw new RuntimeError('Variable "commentForm" does not exist.', 35, $this->source); })()), 'form_start');
            echo "
\t\t";
            // line 36
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["commentForm"]) || array_key_exists("commentForm", $context) ? $context["commentForm"] : (function () { throw new RuntimeError('Variable "commentForm" does not exist.', 36, $this->source); })()), "author", [], "any", false, false, false, 36), 'row', ["attr" => ["placeholder" => " Votre nom"]]);
            // line 38
            echo "
\t\t";
            // line 39
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["commentForm"]) || array_key_exists("commentForm", $context) ? $context["commentForm"] : (function () { throw new RuntimeError('Variable "commentForm" does not exist.', 39, $this->source); })()), "content", [], "any", false, false, false, 39), 'row', ["attr" => ["placeholder" => " Votre commentaire"]]);
            // line 41
            echo "
\t\t<button type=\"submit\" class=\"btn btn-success\"> Commenter </button>
\t\t";
            // line 43
            echo             $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["commentForm"]) || array_key_exists("commentForm", $context) ? $context["commentForm"] : (function () { throw new RuntimeError('Variable "commentForm" does not exist.', 43, $this->source); })()), 'form_end');
            echo "
\t";
        } else {
            // line 45
            echo "\t\t<h3> Vous ne pouvez pas commenter si vous n'etes pas connecté ! </h3>
\t\t<a href=\"";
            // line 46
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("security_login");
            echo "\" class=\"btn btn-primary\"> 
\t\t\tConnexion
\t\t</a>
\t";
        }
        // line 50
        echo "\t</section>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "blog/show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  172 => 50,  165 => 46,  162 => 45,  157 => 43,  153 => 41,  151 => 39,  148 => 38,  146 => 36,  141 => 35,  138 => 34,  127 => 29,  121 => 26,  117 => 25,  112 => 22,  108 => 21,  104 => 20,  97 => 16,  93 => 15,  87 => 12,  82 => 10,  77 => 8,  71 => 5,  68 => 4,  58 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}

{% block body %}
\t<article>
\t\t<h2>{{article.title}}</h2>
\t\t<div class=\"metadata\">
\t\t\tEcrit le
\t\t\t{{article.createdAt | date('d/m/y')}}
\t\t\tà
\t\t\t{{article.createdAt | date('H:i')}}
\t\t\tdans la catégorie
\t\t\t{{article.category.title}}
\t\t</div>
\t\t<div class=\"content\">
\t\t\t<img src=\"{{article.image}} \" alt=\"\">
\t\t\t{{article.content | raw}}
\t\t</div>
\t</article>
\t<section id=\"commentaires\">
\t\t<h1>{{article.comments | length }} commentaires </h1>  
\t{% for comment in article.comments %}
\t\t<div class=\"comment\">
\t\t\t<div class=\"row\">
\t\t\t\t<div class=\"col-3\">
\t\t\t\t\t{{comment.author}}
\t\t\t\t\t(<small>{{comment.createdAt | date('d/m/Y à H:i') }}</small>)
\t\t\t\t</div>
\t\t\t\t<div class=\"col\">
\t\t\t\t\t{{comment.content |raw}}
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t{% endfor %}
\t{% if app.user %}
\t\t{{form_start(commentForm)}}
\t\t{{form_row(commentForm.author,{'attr': {
\t\t\t'placeholder': \" Votre nom\"
\t\t}})}}
\t\t{{form_row(commentForm.content,{'attr': {
\t\t\t'placeholder': \" Votre commentaire\"
\t\t}})}}
\t\t<button type=\"submit\" class=\"btn btn-success\"> Commenter </button>
\t\t{{form_end(commentForm)}}
\t{% else %}
\t\t<h3> Vous ne pouvez pas commenter si vous n'etes pas connecté ! </h3>
\t\t<a href=\"{{path('security_login')}}\" class=\"btn btn-primary\"> 
\t\t\tConnexion
\t\t</a>
\t{% endif %}
\t</section>
{% endblock %}
", "blog/show.html.twig", "/home/yaniv/cours/web/projet/Codify/templates/blog/show.html.twig");
    }
}
