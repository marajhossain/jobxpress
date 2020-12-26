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

/* job_post/index.html.twig */
class __TwigTemplate_06d1172d060fb77317eeb43b73ace77bf470527252b78d1881a81ac0e0c5201f extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "admin.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "job_post/index.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "job_post/index.html.twig"));

        $this->parent = $this->loadTemplate("admin.html.twig", "job_post/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Job Express::JobPost";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "    <div class=\"col-md-6\">
        <h1 class=\"text-info\">Job List</h1>
    </div>
    <div class=\"col-md-6\">
        <a href=\"";
        // line 10
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("job_post_new");
        echo "\" class=\"btn btn-default btn-warning float-right\"> <i class=\"fa fa-plus\"></i> Create new</a>
    </div>
    <table class=\"table table-hover table-bordered\">
        <thead class=\"bg-success\">
            <tr>
                <th rowspan=\"2\">Id</th>
                <th rowspan=\"2\">Company Name</th>
                <th rowspan=\"2\">Type</th>
                <th rowspan=\"2\">Position</th>
                <th rowspan=\"2\">Location</th>
                <th rowspan=\"2\">Description</th>
                <th rowspan=\"2\">Logo</th>
                <th colspan=\"2\" class=\"text-center\">Total</th>
                <th rowspan=\"2\">Poster Email</th>
                <th rowspan=\"2\">Status</th>
                <th rowspan=\"2\">actions</th>
            </tr>
            <tr>
                <th>Applied</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
        ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["job_posts"]) || array_key_exists("job_posts", $context) ? $context["job_posts"] : (function () { throw new RuntimeError('Variable "job_posts" does not exist.', 33, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["job_post"]) {
            // line 34
            echo "            <tr>
                <td>";
            // line 35
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job_post"], "id", [], "any", false, false, false, 35), "html", null, true);
            echo "</td>
                <td>";
            // line 36
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job_post"], "companyName", [], "any", false, false, false, 36), "html", null, true);
            echo "</td>
                <td>";
            // line 37
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job_post"], "type", [], "any", false, false, false, 37), "html", null, true);
            echo "</td>
                <td>";
            // line 38
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job_post"], "position", [], "any", false, false, false, 38), "html", null, true);
            echo "</td>
                <td>";
            // line 39
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job_post"], "location", [], "any", false, false, false, 39), "html", null, true);
            echo "</td>
                <td>";
            // line 40
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job_post"], "description", [], "any", false, false, false, 40), "html", null, true);
            echo "</td>
                <td>";
            // line 41
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job_post"], "logo", [], "any", false, false, false, 41), "html", null, true);
            echo "</td>
                <td>";
            // line 42
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job_post"], "totalApplied", [], "any", false, false, false, 42), "html", null, true);
            echo "</td>
                <td>";
            // line 43
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job_post"], "totalView", [], "any", false, false, false, 43), "html", null, true);
            echo "</td>
                <td>";
            // line 44
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job_post"], "posterEmail", [], "any", false, false, false, 44), "html", null, true);
            echo "</td>
                <td>";
            // line 45
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job_post"], "status", [], "any", false, false, false, 45), "html", null, true);
            echo "</td>
                <td>
                    <a href=\"";
            // line 47
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("job_post_show", ["id" => twig_get_attribute($this->env, $this->source, $context["job_post"], "id", [], "any", false, false, false, 47)]), "html", null, true);
            echo "\" class=\"text-info\"> <i class=\"fa fa-eye\"></i> show</a> |
                    <a href=\"";
            // line 48
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("job_post_edit", ["id" => twig_get_attribute($this->env, $this->source, $context["job_post"], "id", [], "any", false, false, false, 48)]), "html", null, true);
            echo "\" class=\"text-warning\"> <i class=\"fa fa-edit\"></i> edit</a> 
                    ";
            // line 49
            if ($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")) {
                // line 50
                echo "                       | <a href=\"";
                echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("job_post_edit", ["id" => twig_get_attribute($this->env, $this->source, $context["job_post"], "id", [], "any", false, false, false, 50)]), "html", null, true);
                echo "\" class=\"text-danger\"> <i class=\"fa fa-trash\"></i> delete</a>
                    ";
            }
            // line 52
            echo "                </td>
            </tr>
        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 55
            echo "            <tr>
                <td colspan=\"12\">no records found</td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['job_post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 59
        echo "        </tbody>
    </table>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "job_post/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  205 => 59,  196 => 55,  189 => 52,  183 => 50,  181 => 49,  177 => 48,  173 => 47,  168 => 45,  164 => 44,  160 => 43,  156 => 42,  152 => 41,  148 => 40,  144 => 39,  140 => 38,  136 => 37,  132 => 36,  128 => 35,  125 => 34,  120 => 33,  94 => 10,  88 => 6,  78 => 5,  59 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'admin.html.twig' %}

{% block title %}Job Express::JobPost{% endblock %}

{% block body %}
    <div class=\"col-md-6\">
        <h1 class=\"text-info\">Job List</h1>
    </div>
    <div class=\"col-md-6\">
        <a href=\"{{ path('job_post_new') }}\" class=\"btn btn-default btn-warning float-right\"> <i class=\"fa fa-plus\"></i> Create new</a>
    </div>
    <table class=\"table table-hover table-bordered\">
        <thead class=\"bg-success\">
            <tr>
                <th rowspan=\"2\">Id</th>
                <th rowspan=\"2\">Company Name</th>
                <th rowspan=\"2\">Type</th>
                <th rowspan=\"2\">Position</th>
                <th rowspan=\"2\">Location</th>
                <th rowspan=\"2\">Description</th>
                <th rowspan=\"2\">Logo</th>
                <th colspan=\"2\" class=\"text-center\">Total</th>
                <th rowspan=\"2\">Poster Email</th>
                <th rowspan=\"2\">Status</th>
                <th rowspan=\"2\">actions</th>
            </tr>
            <tr>
                <th>Applied</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
        {% for job_post in job_posts %}
            <tr>
                <td>{{ job_post.id }}</td>
                <td>{{ job_post.companyName }}</td>
                <td>{{ job_post.type }}</td>
                <td>{{ job_post.position }}</td>
                <td>{{ job_post.location }}</td>
                <td>{{ job_post.description }}</td>
                <td>{{ job_post.logo }}</td>
                <td>{{ job_post.totalApplied }}</td>
                <td>{{ job_post.totalView }}</td>
                <td>{{ job_post.posterEmail }}</td>
                <td>{{ job_post.status }}</td>
                <td>
                    <a href=\"{{ path('job_post_show', {'id': job_post.id}) }}\" class=\"text-info\"> <i class=\"fa fa-eye\"></i> show</a> |
                    <a href=\"{{ path('job_post_edit', {'id': job_post.id}) }}\" class=\"text-warning\"> <i class=\"fa fa-edit\"></i> edit</a> 
                    {% if is_granted('ROLE_ADMIN') %}
                       | <a href=\"{{ path('job_post_edit', {'id': job_post.id}) }}\" class=\"text-danger\"> <i class=\"fa fa-trash\"></i> delete</a>
                    {% endif %}
                </td>
            </tr>
        {% else %}
            <tr>
                <td colspan=\"12\">no records found</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
{% endblock %}
", "job_post/index.html.twig", "D:\\xampp\\htdocs\\symfony_job_express\\templates\\job_post\\index.html.twig");
    }
}
