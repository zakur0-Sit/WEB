<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <h1>FoSA</h1>
    <link rel="stylesheet" href="css/scholarly.min.css">
    
  </head>
  <body>
    <div role="contentinfo">
      <dl>
        <dt>Authors</dt>
        <dd>
          Cazacu Ion &&  Țigănescu Ioan Iustin
        </dd>
        <dt>Bugs &amp; Feedback</dt>
        <dd>
          <a href="https://github.com/w3c/scholarly-html/issues">Issues and PRs welcome!</a>
        </dd>
        <dt>Discussion Group</dt>
        <dd>
          The <a href="https://www.w3.org/community/scholarlyhtml/">Scholarly HTML Community
          Group</a> at <a href="https://w3.org/">W3C</a>
          (<a href="https://lists.w3.org/Archives/Public/public-scholarlyhtml/">email archives</a>)
        </dd>
        <dt>License</dt>
        <dd>
          <a href="http://creativecommons.org/licenses/by/4.0/">CC-BY</a>
        </dd>
      </dl>
    </div>
    <section typeof="sa:Abstract" id="abstract" role="doc-abstract">
      <h2>Abstract</h2>
      <p>
        Scholarly HTML is a domain-specific rich document format built entirely on open standards
        that enables the interoperable exchange of scholarly articles in a manner that is compatible
        with off-the-shelf browsers. This document describes how Scholarly HTML works and how it is
        encoded.
      </p>
    </section>
    <section id="introduction" role="doc-introduction">
      <!-- review? -->
      <h2>Introduction</h2>
      <p>
        Scholarly articles are still primarily published as unstructured data in which most of the
        information created by the research and the practice of authoring is lost. Document
        technology has reached a level of maturity and universality that makes this situation no
        longer tenable. Information cannot be disseminated if it is destroyed before even having
        left its creator’s laptop.
      </p>
      <p>
        According to the New York Times, adding structured information to their recipes improved
        their discoverability to the point of producing an immediate rise of 52 percent in traffic
        (<a role="doc-biblioref">NYT</a>). At this point in time, cupcake recipes are reaping
        greater benefits from modern data format practices than the whole scientific endeavour.
      </p>
      <p>
        This places a great burden on tool developers and service providers as well. Anyone who
        has explored the world of extracting data from inert publications has built their own
        complex toolset, offering no interoprability, no opportunity for cooperative improvements,
        and little or no growth in discoverability or meta-analysis in this area.
      </p>
      <p>
        To address these issues, we have followed an approach rooted in established best practices
        for the reuse of open, standard formats. We propose an "HTML Vernacular", a set of
        guidelines for the creation of domain-specific data formats that make use of HTML’s
        inherent extensibility  (<a role="doc-biblioref">Science.AI, 2015</a>). Using the
        vernacular foundation overlaid with schema.org metadata and proposed extensions to it, we
        have produced a format for the authoring and interchange of scholarly articles built on
        open standards, ready for all to use. We hope that this format will be usable
        <a href="http://www.nytimes.com/2016/03/16/science/asap-bio-biologists-published-to-the-internet.html?_r=1">rogue
        scientists</a> who choose to publish their articles on their own.
      </p>
      <p>
        Our high-level goals are to:
      </p>
      <ul>
        <li>Enable structured metadata, accessibility, and internationalisation.</li>
        <li>Be fully funcitioning on modern Web browsers.</li>
        <li>
          Be customizable for inclusion in arbitrary Web sites, while remaining easy to process
          and interoperable.
        </li>
        <li>Build on top of open, royalty-free standards.</li>
        <li>Long-term viability as a data format.</li>
      </ul>
      <p>
        Where semantic modeling is concerned, our approach is to stick as much as possible to the
        schema.org. Beyond the obvious advantages there are in reusing a vocabulary that is
        supported by all the major search engines and is actively being developed towards enabling a
        shared understanding of many useful concepts, it also provides a protection against
        <i>ontological drift</i> whereby a new vocabulary is defined by a small group with
        insufficient input from a broader community of practice. A language that solely a single
        participant understands is of limited value.
      </p>
      <p>
        In a limited number of cases we have had to depart from schema.org, using the
        <code>https://ns.science.ai/</code>, prefixed with <code>sa:</code>. Our goal is to work
        with schema.org in order to extend their vocabulary, and we will align our usage with the
        outcome of these discussions.
      </p>
    </section>
    <section id="structure">
      <!-- review? -->
      <h2>Structure</h2>
      <p>
        A Scholarly HTML document is a valid <a role="doc-biblioref">HTML</a> document that follows
        some additional rules to specialize its meaning and make it predictable to processors
        wishing to produce or consume scholarly articles. These rules are outlined in the following
        sections. While valuable on its own, the content structure defined here is simply a stepping
        stone to enable semantic enrichment, detailed in <a href="#semantics">Semantics
        Overlays</a>. If you would like to write a validation tool, please join us on GitHub.
      </p>
      <section id="Root">
        <!-- review? -->
        <h3>The root and <code>head</code></h3>
        <p>
          The document must be encoded in UTF-8 and transmitted with a media type of
          <code>text/html</code>.
        </p>
        <p>
          The <code>head</code> must contain <code>&lt;meta charset="utf-8"&gt;</code> element and a
          <code>title</code> element.
        </p>
      </section>
      <section id="article">
        <!-- review? -->
        <h3>The <code>article</code></h3>
        <p>
          The first child of <code>article</code> must be <code>header</code>. The header should
          contain an <code>h1</code> with the title of the document. The following element must be a
          <code>div</code> with the role of <code>contentinfo</code> containing author and
          affiliation information. See <a href="#contentinfo-semantics">The <code>contentinfo</code>
          Region Semantics</a> for information about the semantic decoration of this element.
        </p>
        <p>
          Any number of <code>section</code> elements may be listed within the article at arbitrary
          depths, but each <code>section</code> must begin with an <code>hx</code> element,
          indicating a numbered section in the article. If the sections require headings that exceed
          <code>h6</code>, <code>aria-level</code> must be included to indicate depth.
        </p>
        <figure typeof="schema:SoftwareSourceCode" role="doc-example" id="arialevelexample">
          <pre><code>
    &lt;section>      
      &lt;h6>Granular Details about Zoology&lt;/h6>
        &lt;p>…&lt;/p>
      &lt;section>    
        &lt;h6 aria-level="7">Even More Information!&lt;/h6>
          </code></pre>
          <figcaption>Example of a level 7 heading, using <code>aria-level</code></figcaption>
        </figure>
        <p>
          Each section may contain zero or more <a href="#hunk">Hunk Elements</a> and
          <code>section</code> elements.
        </p>
      </section>
      <section id="hunk">
        <!-- review? -->
        <h3>Hunk Elements</h3>
        <p>
          Hunk elements are the meaningful blocks from which sections are built. They contain text
          and <a href="#inline">inline elements</a>.   There are several types of hunk elements. All
          content, ranging from long paragraphs to note references and footnotes can be captured
          using this specified set of elements. The method for distinguishing one from another in a
          machine-readable manner is specified in <a href="#semantics">Semantics Overlay</a>.
        </p>
        <p>
          The most common hunk element is
          <a href="https://www.w3.org/TR/html51/semantics.html#the-p-element"><code>p</code></a>.
        </p>
        <p>
          The
          <a href="https://www.w3.org/TR/html51/semantics.html#the-blockquote-element"><code>blockquote</code></a>,
          <a href="https://www.w3.org/TR/html51/semantics.html#the-ul-element"><code>ul</code></a>,
          <a href="https://www.w3.org/TR/html51/semantics.html#the-ol-element"<code>ol</code></a>,
          and
          <a href="https://www.w3.org/TR/html51/semantics.html#the-dl-element"><code>dl</code></a>
          elements can be used as they typically would and require no special treatment.
        </p>
        <p>
          The
          <a href="https://www.w3.org/TR/html51/semantics.html#the-dl-element"<code>aside</code></a>
          hunk element is used to capture portions of content that stand apart from the main flow of
          content. These can be separated from the article without having impact on the reader’s
          understanding of the article. A common use is text boxes in print. If the
          <code>aside</code> contains an <code>header</code> heading element, that heading must be
          the first element child and its numeric part must reflect its depth, making use of
          <code>aria-level</code> according to the same rules that apply for <code>section</code>.
          The other children of asid<code>aside</code>e must all be hunk elements. For example, if
          an <code>aside</code> follows a <code>section</code> with a level 3 heading, the top-level
          heading in the <code>aside</code> should be <code>h4</code>.
        </p>
        <section id="figures">
          <!-- review? -->
          <h4>Figures</h4>
          <p>
            The
            <a href="https://www.w3.org/TR/html51/semantics.html#the-figure-element"><code>figure</code></a>
            element is a general container for self-contained content units that are embedded inside
            the main body of the text. It can come in several flavors that are dictated by its
            <code>typeof</code> attribute. Common uses for <code>figure</code> are as a container
            for images, tables, equations, and computer code.
          </p>
          <p>
            If <code>figure</code> is <code>typeof="sa:image"</code>, it is an image container. It
            must contain an <code>img</code> child element and should contain a <code>figcaption</code>
            labeling that image.
          </p>
          <p>
            If <code>figure</code> is a <code>typeof="sa:table"</code>table, it is a table
            container. It must contain a <code>table</code> element. If there is a table caption, it
            should be included using the <code>caption</code> child element of the table, and not
            the <code>figcaption</code> child of the <code>figure</code>. Table notes may also be
            included as <code>ol</code> with <code>li</code> elements with the role of
            <code>doc-footnote</code>.
          </p>
          <p>
            If <code>figure</code> is a <code>typeof="sa:formula"</code>, it is a formula container.
            It must contain a <code>math</code> element and, optionally, a <code>figcaption</code>
            describing the formula. The <code>math</code> element must be valid MathML 3.
            Additionally, given the dismal state of support for MathML in Web browsers the math
            element must contain an annotation descendant with the TeX equivalent of the formula.
          </p>
          <p>
            If <code>figure</code> is a <code>typeof="schema:SoftwareSourceCode"</code>, it is a
            code container. It must contain a <code>pre</code> element and, optionally, a
            <code>figcaption</code>. The <code>pre</code> element must contain a <code>code</code>
            element as its only child.
          </p>
        </section>
      </section>
      <section id="inline">
        <!-- review? -->
        <h3>Inline Elements</h3>
        <p>
          <a href="https://www.w3.org/TR/html51/semantics.html#text-level-semantics">Inline
          elements</a> decorate, describe, and enrich text. Inline elements can be used inside of
          hunk elements, heading elements, and captioning elements. Where applicable, they can nest
          within one another. Inline images and inline math can be inlcuded as well. This can be
          accomplished using <code>img</code> for images or <code>math</code> for formulas.
          Equations can be displayed inline or as blocks within a paragaph.
        </p>
        <figure typeof="schema:SoftwareSourceCode" resource="#mathblock-example"
                id="mathblock-example" role="doc-example">
          <pre><code>
&lt;p>
  If we should weep when clowns put on their show,
  if we should stumble when musicians play,
  &lt;math display="block">
    &lt;semantics>
      &lt;mrow>
        &lt;mi>Δ&lt;/mi>&lt;msup>&lt;mi>E&lt;/mi>&lt;mn>2&lt;/mn>&lt;/msup>
        &lt;mspace width="0.222em">&lt;/mspace>
        &lt;mo>=&lt;/mo>
        &lt;mspace width="0.222em">&lt;/mspace>
        &lt;msub>&lt;mi>q&lt;/mi>&lt;mi>i&lt;/mi>&lt;/msub>
        &lt;mspace width="0.222em">&lt;/mspace>
        &lt;mo>×&lt;/mo>
        &lt;mspace width="0.222em">&lt;/mspace>
        &lt;mo stretchy="false" form="prefix">(&lt;/mo>
        &lt;msub>
          &lt;msup>&lt;mi>F&lt;/mi>&lt;mn>2&lt;/mn>&lt;/msup>
          &lt;mrow>
            &lt;mo stretchy="false" form="prefix">(&lt;/mo>
            &lt;mi>i&lt;/mi>&lt;mo>,&lt;/mo>
            &lt;mspace width="0.222em">&lt;/mspace>
            &lt;mi>j&lt;/mi>
            &lt;mo stretchy="false" form="postfix">)&lt;/mo>
          &lt;/mrow>
        &lt;/msub>
        &lt;mspace width="0.222em">&lt;/mspace>
        &lt;mo>/&lt;/mo>
        &lt;mspace width="0.222em">&lt;/mspace>
        &lt;msub>&lt;mi>ε&lt;/mi>&lt;mi>j&lt;/mi>&lt;/msub>
        &lt;mspace width="0.222em">&lt;/mspace>&lt;mspace width="0.222em">&lt;/mspace>
        &lt;msub>&lt;mi>ε&lt;/mi>&lt;mi>i&lt;/mi>&lt;/msub>
        &lt;mo stretchy="false" form="postfix">)&lt;/mo>
      &lt;/mrow>
    &lt;/semantics>
  &lt;/math>
  time can say nothing but I told you so.
&lt;/p>
          </code></pre>
          <figcaption></figcaption>
        </figure>
      </section>
      <section id="references">
        <!-- review? -->
        <h3>References</h3>
        <p>
          The References section requires specific <a href="#citations">semantic overlays</a>
          (reference) as well as strict content structure. Apart from a (required) <code>hx</code>
          element, it must contain only one <code>ol</code> or <code>dl</code> element.
        </p>
        <p>
          If using a <code>dl</code> element, the contents must be alternating <code>dt</code> and
          <code>dd</code> elements. The <code>dd</code> must contain the citation.
        </p>
        <!-- XXX add references to sem as well as CSS to rearrange order based on citation format -->
        <p>
          If using <code>ol</code>, the only contents are <code>li</code> that include citations.
        </p>
      </section>

      <section id="interactive">
        <!-- review? -->
        <h3>Interactive Elements</h3>
        <p>
          information about iframes to come
        </p>
        <p class="issue">
          Let’s discuss details of iframes with the CG
        </p>
      </section>
      <section id="HTMLRoles">
        <!-- review? -->
        <h3>HTML Roles</h3>
        <p>
          It is possible to provide information about an HTML element by decorating it with the
          <a href="https://www.w3.org/TR/html51/dom.html#aria-role-attribute">role</a> attribute. The
          <a href="https://www.w3.org/TR/wai-aria-1.1/">ARIA</a> vocabulary and its extensions provide
          convenient terms that are relevant to document structure. The following roles from ARIA and
          <a href="https://www.w3.org/TR/dpub-aria-1.0/">DPUB-ARIA</a> should be applied where
          appropriate:
        </p>
        <ul>
          <li>
            <a href="https://www.w3.org/TR/wai-aria-1.1/#contentinfo">contentinfo</a> to apply to the
            <code>div</code> containing author and affiliation information
          </li>
          <li>
            <a href="https://www.w3.org/TR/wai-aria-1.1/#definition">definition</a> for defining a
            term, such as a keyword or a glossary term
          </li>
          <li>
            <a href="https://www.w3.org/TR/wai-aria-1.1/#term">term</a> for a term corresponding to a
            definition
          </li>
          <li>
            <a href="https://www.w3.org/TR/wai-aria-1.1/#presentation">presentation</a> to indicate
            that an image is purely decorative
          </li>
          <li>
            <a href="https://www.w3.org/TR/dpub-aria-1.0/#doc-abstract">doc-abstract</a> on the
            <code>section</code> that contains the abstract
          </li>
          <li>
            <a href="https://www.w3.org/TR/dpub-aria-1.0/#doc-acknowledgments">doc-acknowledgments</a>
            on the <code>section</code> that contains acknowledgements (note that this is not the same
            as funding information).
          </li>
          <li>
            <a href="https://www.w3.org/TR/dpub-aria-1.0/#doc-appendix">doc-appendix</a> on the
            <code>section</code> that contains the appendix
          </li>
          <li>
            <a href="https://www.w3.org/TR/dpub-aria-1.0/#doc-biblioentry">doc-biblioentry</a> on the
            list item that includes a citation
          </li>
          <li>
            <a href="https://www.w3.org/TR/dpub-aria-1.0/#doc-bibliography">doc-bibliography</a> on
            the <code>section</code> or list that contains the references or works cited
          </li>
          <li>
            <a href="https://www.w3.org/TR/dpub-aria-1.0/#doc-conclusion">doc-conclusion</a> on the
            <code>section</code> that explicity concludes the article
          </li>
          <li>
            <a href="https://www.w3.org/TR/dpub-aria-1.0/#doc-dedication">doc-dedication</a> on the
            dedication element of the article (allowed on any hunk element)
          </li>
          <li>
            <a href="https://www.w3.org/TR/dpub-aria-1.0/#doc-endnote">doc-endnote</a> on an
            individual note item in a collection of notes
          </li>
          <li>
            <a href="https://www.w3.org/TR/dpub-aria-1.0/#doc-dedication">doc-endnotes</a> on the
            <code>section</code> containing a group of notes
          </li>
          <li class="issue">
            <a href="https://www.w3.org/TR/dpub-aria-1.0/#doc-errata">doc-errata</a> on a ???
          </li>
          <li>
            <a href="https://www.w3.org/TR/dpub-aria-1.0/#doc-example">doc-example</a> on a hunk
            element containing an illustrative concept, such as a code sample.
          </li>
          <li>
            <a href="https://www.w3.org/TR/dpub-aria-1.0/#doc-footnote">doc-footnote</a> on a hunk
            element containing an individual note, such as an informative note about the author or
            table footnote
          </li>
          <li>
            <a href="https://www.w3.org/TR/dpub-aria-1.0/#doc-introduction">doc-introduction</a> on
            the <code>section</code> introducing the article, if relevant
          </li>
          <li>
            <a href="https://www.w3.org/TR/dpub-aria-1.0/#doc-subtitle">doc-subtitle</a> to indicate
            that a portion of a heading is a secondary or alternate title of the work
          </li>
        </ul>
        <p class="issue">
          Should we require ARIA’s table, grid, rowheader, and rowgroup?
        </p>
        <p class="issue">
          I did not include doc-credit bc of extensive citation markup in JSON-LD
        </p>
        <p class="issue">
          doc-endnote, doc-endnotes are not in the current published draft of DPUB-ARIA. See
          <a href="http://rawgit.com/w3c/aria/master/aria/dpub.html">March DPUB-ARIA draft</a>
        </p>
      </section>
      <section id="validate">
        <!-- review? -->
        <h3>Validation</h3>
        <p>
          The only validation requirement for Scholarly HTML at this point is that the HTML is valid.
          We are considering building a a validation tool in RelaxNG or JavaScript to check compliance
          with this set of rules.
        </p>
        <p>
          Articles should be in the following basic structure:
        </p>
        <ul>
          <li>heading with article title</li>
          <li>0+ hunks</li>
          <li>
            0+ sections
            <ul>
              <li>0+ headings</li>
              <li>0+ hunks</li>
              <li>0+ sections</li>
            </ul>
          </li>
        </ul>
        <p>
          It must feature a <code>DOCTYPE</code> as its preamble.
        </p>
      </section>
    </section>
    <section id="semantics">
      <!-- review? -->
      <h2>Semantics Overlay</h2>
      <p>
        HTML provides an excellent backbone with which to capture the
        <a href="#structure">structure</a> of a given text but is evidently limited when it comes to
        capturing more domain-specific concepts such as people, spaceships,
        <a href="http://existentialcomics.com/comic/122">Humean causation</a>, or
        <a href="http://journals.plos.org/plosone/article?id=10.1371/journal.pone.0109888">sthenurines</a>.
        That is where semantic overlays with the ability to refine the meaning and relations of
        HTML elements come into play. Scholarly HTML makes use of two standard mechanisms that
        overlay additional semantics atop the HTML DOM: role-based semantics as defined by
        <a role="doc-biblioref">WAI-ARIA</a> and <a role="doc-biblioref">DPUB-ARIA</a>, and
        semantics rooted in structured data as captured by <a role="doc-biblioref">RDFa</a>.
      </p>
      <p>
        Using technologies related to the semantic web can at times feel daunting and unrelated to
        everyday web development. In order to suppress this disconnect, Scholarly HTML follows a
        few simple guiding principles:
      </p>
      <ul>
        <li>
          The number of prefixes used for semantic properties is kept as small as possible;
        </li>
        <li>
          There is no such thing as a URI (or URN, IRI, XRI, or whatever else confusing
          contraption), everything is a URL;
        </li>
        <li>
          Where somewhat more complex modeling is required, it is put together using a small set of
          common patterns that might require some initial learning but can be applied regularly
          with relative ease (notably <a href="#roles">roles</a> and actions).
        </li>
      </ul>
      <p>
        The properties that Scholarly HTML uses are naturally document-related (authorship,
        keywords, license, citations, as well as specific structure types such as acknowledgements,
        introduction, or funding), which additionally requires the ability to describe people and
        organizations. There are numerous vocabularies that address this domain and which could be
        used with <a role="doc-biblioref">RDFa</a>; however, for reasons detailed in
        <a href="https://research.science.ai/article/web-first-data-citations#choice-of-ontology">Web-First
        Data Citations</a> Scholarly HTML relies almost exclusively on
        <a role="doc-biblioref">schema.org</a>, complemented by a small number of additions from
        the <a href="#scholarly-article">Scholarly Article Vocabulary</a>.
      </p>
      <section id="person-org">
        <!-- review? -->
        <h3>Persons &amp; Organizations</h3>
        <p>
          Marking up persons and organizations can make use of any applicable properties in
          <a>schema:Person</a> and <a>schema:Organization</a>, respectively, but it is worth
          pointing out some good practices with how these are to be used in practice.
        </p>
        <p>
          If the entity in question has a URL then it is best to use that as its identifier (using
          the <code>resource</code> attribute) and additionally to provide it as a link using the
          <code>a</code> element (see the <a href="#person-example">person example</a> for an
          instance of this).
        </p>
        <p>
          If you happen to have information providing both the
          <a>schema:givenName</a>/<a>schema:familyName</a><a>schema:additionalName</a> triple and
          the <a>schema:name</a> (which can be considered to contain the name as the person wishes
          it to be displayed) for a person then it is (perhaps counterintuitively) best to
          include <em>all</em> of them and then use CSS (typically sibling selectors) to hide the
          extraneous ones (alternatively, they can be captured using the <code>meta</code> element).
          The reason for this is that it exposes more information to machine consumers without
          having a negative impact on human readers.
        </p>
        <figure typeof="schema:SoftwareSourceCode" resource="#person-example" id="person-example">
          <pre><code>
&lt;span typeof="schema:Person" resource="http://orcid.org/0000-0003-1279-3709">
  &lt;meta property="schema:givenName" content="Bruce">
  &lt;meta property="schema:familyName" content="Banner">
  &lt;a href="http://orcid.org/0000-0003-1279-3709">
    &lt;span property="schema:name">Dr. Bruce Banner&lt;/span>
  &lt;/a>
&lt;/span>
          </code></pre>
          <figcaption>
            <span property="schema:name"></span>
            <span property="schema:description">
              Example of a Person. This demonstrates the use of extraneous name information using
              <code>meta</code> elements. The container is a <code>span</code> but it could be any
              other container element. This also shows how <a>schema:name</a> can be used for the
              person’s preferred display name, as distinct from the more specific structured name
              information.
            </span>
          </figcaption>
        </figure>
        <p>
          Here is also an organization:
        </p>
        <figure typeof="schema:SoftwareSourceCode" resource="#org-example" id="org-example">
          <pre><code>
&lt;span typeof="schema:Organization" resource="https://www.w3.org/">
  &lt;a href="https://www.w3.org/">
    &lt;span property="schema:name">W3C&lt;/span>
  &lt;/a>
  (&lt;span property="schema:location" typeof="schema:Place">
    &lt;span property="schema:address" typeof="schema:PostalAddress">
      &lt;span property="schema:addressLocality">Cambridge&lt;/span>,
      &lt;span property="schema:addressRegion">MA&lt;/span>,
      &lt;span property="schema:addressCountry">USA&lt;/span>
    &lt;/span>
  &lt;/span>)
&lt;/span>
          </code></pre>
          <figcaption>
            <span property="schema:name"></span>
            <span property="schema:description">
              Example of an Organization. This also features the organization’s address.
            </span>
          </figcaption>
        </figure>
        <p class="issue">
          How should we represent name transliterations? Are there language tags for transliterated
          text? Or should ruby+rdf:HTML be suggested instead? If the latter we can no longer use
          <code>meta</code> (which is acceptable).
        </p>
      </section>
      <section id="typing-sections">
        <!-- review? -->
        <h3>Typing Sections</h3>
        <p>
          XXX
        </p>
      </section>
      <section id="roles">
        <!-- review? -->
        <h3>Schema Roles</h3>
        <!--
          XXX needs rewrite, Dave doesn’t understand, ergo no one will
          DC suggests contrasting two examples: one in which I am eternally indentured to the
          Illuminati, versus one in which I am just a hired gun.
        -->
        <p>
          It is worth taking a step back to understand the importance of the <em>role</em>
          modeling. Its application is clearly exemplified in the <a href="#authors">Authors &amp;
          Contributors</a> section wherein a <a>sa:ContributorRole</a> type is used as a wrapper
          and not <a>schema:Person</a> or <a>schema:Organization</a> directly.
        </p>
        <p>
          Roles are an indirection that provides additional information about a property or
          relationship. A simple overview is provided in the schema.org blog post
          <a href="http://blog.schema.org/2014/06/introducing-role.html">Introducing ’Role’</a>.
        </p>
        <p>
          Let’s look at the example of authorship information. Some properties of the agent who
          authored the document (person or organization), such as their name, are considered to be
          true outside the limited context of the document. These properties will be set directly on
          the agent.
        </p>
        <p>
          On the other hand, other properties are considered to be specific to the agent
          <em>in their role as author of the document</em>. To give an example, were I to be
          writing the document you are currently reading as a freelancer for the Illuminati, my
          affiliation to them would be solely in my role as author and I should not be considered
          eternally indentured to them.
        </p>
        <p>
          When a role is used to enrich a property, the convention is to have it as the value of
          that property, and then to repeat the property on the role to point to the object. At
          first glance it sounds contrived, but it is a simple and powerful construct. To stay with
          the authoring example, the indirection would look like:
        </p>
        <p>
          <a>schema:ScholarlyArticle</a> ⟼
          <em><a>schema:author</a></em> ⟼
          <a>sa:ContributorRole</a> ⟼
          <em><a>schema:author</a></em> ⟼
          <a>schema:Person</a>
        </p>
        <p>
          To demonstrate how properties can attach differently to the role and to the agent, we can
          unfold the authorship example further:
        </p>
        <figure typeof="schema:SoftwareSourceCode" resource="#role-example" id="role-example">
          <pre>
<a>schema:ScholarlyArticle</a>
└─<a>schema:author</a>
  └─<a>sa:ContributorRole</a>
    ├─<a>schema:author</a>
    │ └─<a>schema:Person</a>
    │   ├─<a>schema:name</a> = Bruce Banner
    │   └─<a>schema:url</a> = http://berjon.com/
    └─<a>sa:roleAffiliation</a>
      └─<a>schema:Organization</a>
        ├─<a>schema:name</a> = Illuminati
        └─<a>schema:address</a> = Bavaria
          </pre>
          <figcaption>
            <span property="schema:name"></span>
            <span property="schema:description">
              Example of a role being used to model authorship. This effectively states that my
              affiliation <em>as a contributor</em> is to the Illuminati and that my name
              <em>as a person</em> is Bruce Banner.
            </span>
          </figcaption>
        </figure>
      </section>
      <section id="actions">
        <!-- review? -->
        <h3>Actions</h3>
        <p>
          Actions are a global <a role="doc-biblioref">schema.org</a> mechanism to convey facts
          about things that can be or have been <em>done</em>. There is an
          <a href="http://schema.org/docs/actions.html">overview document for actions</a> but it
          dives deep very fast and may be more confusing than helpful. This sections intends to
          convey all that one needs to know about actions in order to understand their usage in
          Scholarly HTML (keeping in mind that they can do much more).
        </p>
        <p>
          Note that actions can do much more than what Scholarly HTML uses them for. For instance,
          if you use an email client that supports actions (such as GMail) you may have noticed that
          some emails allow for direct interactions: those are implemented using actions, and
          without scripting.
        </p>
        <p>
          Actions have a type (e.g. <code>ReadAction</code>, <code>DrinkAction</code>), a status
          (completed, in progress…), an agent being whoever carries it out, and an object which is
          what they are being done to. They can also have start and end times (as well as several
          other properties which we won’t go into here). Scholarly articles typically feature
          indications about things that people have done, which is a good fit for modeling with
          actions. A few examples should help clarify the notion.
        </p>
        <p>
          When referencing an online work, it is customary to indicate the access date for it (since
          it may have changed in the meantime). This can be modeled as a <a>schema:ReadAction</a>,
          with its <a>schema:actionStatus</a> set to <code>CompletedActionStatus</code>, and a
          <a>schema:endTime</a> being the access date. In JSON-LD it would look like this:
        </p>
        <figure typeof="schema:SoftwareSourceCode" resource="#read-action-example" id="read-action-example">
          <pre><code>
{
  "@type":        "ReadAction",
  "actionStatus": "CompletedActionStatus",
  "endTime":      "1977-03-15"
}
          </code></pre>
          <figcaption>
            <span property="schema:name"></span>
            <span property="schema:description">
              Example of a <a>schema:ReadAction</a> used to model the access date of an online
              citation. Both the object and the agent are implicit in the context in which it is
              used.
            </span>
          </figcaption>
        </figure>
        <p>
          Authors often acknowledge the contributions of others or have to disclose potential
          conflicts of interest that may stem from their interactions outside of the article.
          The former can be conveyed as an <a>sa:AcknowledgeAction</a> in which the
          <a>schema:name</a> of the action is the verb part of the acknowledgement and the
          <a>schema:recipient</a> is the person (or entity of any kind) being acknowledged. The
          agent is typically implicitly specified as the object to which the action is attached.
        </p>
        <figure typeof="schema:SoftwareSourceCode" resource="#read-action-example" id="read-action-example">
          <pre><code>
{
  "@type": "AcknowledgeAction",
  "actionStatus": "CompletedActionStatus",
  "name": "is thankful for the pioneering contribution of",
  "recipient": {
    "@type": "Person",
    "name": "Vannevar Bush",
  }
}
            </code></pre>
          <figcaption>
            <span property="schema:name"></span>
            <span property="schema:description">
              Example of an <a>sa:AcknowledgeAction</a> in which the author (not shown) acknowledges
              contributions from Vannevar Bush.
            </span>
          </figcaption>
        </figure>
      </section>
      <section id="article-title-semantics">
        <!-- review? -->
        <h3>Article and Title Semantics</h3>
        <p>
          The <code>article</code> element that roots the content of the Scholarly HTML document
          needs further refinement to capture the specific type of article that it encodes. The
          <code>typeof</code> attribute should always contain <a>schema:ScholarlyArticle</a> as its
          first item, but it can be further refined with additional article types.
        </p>
        <p class="issue">
          Should we recommend a specific taxonomy for article (sub)typing? There are so many:
          Fabio, MeSH, NPG…
        </p>
        <p>
          In order for arbitrary parts of the document to be able to attach metadata to the
          <code>article</code>, it also needs to have its <code>resource</code> attribute set to a
          URL that can be referenced (it is typically sufficient to just use <code>#</code> for that
          purpose).
        </p>
        <p>
          While the <code>h1</code> in the document’s <code>header</code> is sufficient to convey
          the fact that it is the document’s title, some services use extraneous information in
          order to assign an unambiguous title to the document. As such, it needs to have its
          <code>property</code> attribute set to <a>schema:name</a>. Similary, if a subtitle is
          present in the <code>header</code> it needs to be decorated with both a <code>role</code>
          of <code>doc-subtitle</code> (to expose its <a role="doc-biblioref">DPUB-ARIA</a>
          semantics) and a <code>property</code> of <a>schema:alternateName</a>.
        </p>
        <p>
          If appropriate, the beginning of the <code>article</code> is also a good place in which to
          capture the accessibility properties of the document, using the relevant parts of
          <a role="doc-biblioref">schema.org</a> (<a>schema:accessibilityFeature</a>,
          <a>schema:accessibilityHazard</a>, <a>schema:accessibilityAPI</a>, and
          <a>schema:accessibilityControl</a>, as detailed in
          <a href="https://www.w3.org/wiki/WebSchemas/Accessibility">the WebSchemas Accessibility
          wiki page</a>).
        </p>
        <figure typeof="schema:SoftwareSourceCode" resource="#article-example" id="article-example">
          <pre><code>
&lt;article <strong>resource="#" typeof="schema:ScholarlyArticle"</strong>>
  &lt;header>
    &lt;h1 <strong>property="schema:name"</strong>>Is Cryptopaleozoology Hopeless?&lt;/h1>
    &lt;p <strong>role="doc-subtitle" property="schema:alternateName"</strong>>
      The Future of the Scientific Method
    &lt;/p>
  &lt;/header>
  <strong>&lt;meta property="schema:accessibilityFeature" content="alternativeText">
  &lt;meta property="schema:accessibilityFeature" content="MathML">
  &lt;meta property="schema:accessibilityHazard" content="noFlashingHazard"></strong>
&lt;/article>
          </code></pre>
          <figcaption>
            <span property="schema:name"></span>
            <span property="schema:description">
              Example of <code>article</code> and title markup.
            </span>
          </figcaption>
        </figure>
      </section>
      <section id="contentinfo-semantics">
        <!-- review? -->
        <h3>The <code>contentinfo</code> Region Semantics</h3>
        <p>
          As described in the <a href="#structure">Structure section</a>, the <code>contentinfo</code>
          region serves as a container for the metadata of the article. It is itself nothing more
          than a <code>div</code> with a <code>role</code> of <code>contentinfo</code>, but its
          content has rich structure.
        </p>
        <p>
          It contains a list of <code>section</code> elements, each of which is identified with a
          specific <code>typeof</code> attribute.
        </p>
        <section id="authors">
          <!-- review? -->
          <h4>Authors &amp; Contributors</h4>
          <p>
            If the document has authors or contributors, they are listed in a <code>section</code>
            with <code>typeof</code> <a>sa:AuthorsList</a>. The content of that <code>section</code>
            is an <code>h2</code> title appropriate for it, followed by either a <code>ul</code> or
            <code>ol</code> (depending on whether the authors are considered ordered, which is
            highly dependent on the discipline’s culture).
          </p>
          <p>
            Each <code>li</code> in that list must feature a <code>typeof</code> of
            <a>sa:ContributorRole</a> and a property of either <a>schema:author</a> or
            <a>schema:contributor</a> depending on which is applicable. Modeling with schema.org
            roles is explained in the <a href="#roles">Roles</a> section.
          </p>
          <p>
            The <a>sa:ContributorRole</a> <code>span</code> is structured as follows:
          </p>
          <ul>
            <li>
              Exactly one <code>span</code> with a <code>property</code> of either
              <a>schema:author</a> or <a>schema:contributor</a> (matching the one that points to the
              role) and <code>typeof</code> either <a>schema:Person</a> (if the author is a sentient
              entity) or <a>schema:Organization</a> (if it is a collective thereof). How to capture
              persons and organizations is detailed in the creatively-named
              <a href="#person-org">Persons &amp; Organizations</a> section.
            </li>
            <li>
              Zero or more <code>a</code> elements with a <code>property</code> of
              <a>sa:roleAffiliation</a>, one for each affiliation of the author in producing the
              article. Each of those elements needs further to have a <code>resource</code>
              attribute matching the one on the affiliation it is pointing to and an
              <code>href</code> attribute linking to the element on which that affiliation is
              defined. The <code>a</code> element may contain arbitrary text (typically a number,
              letter, or symbol matching that used by the target in its own list). These should not
              occur if the agent is an organization.
            </li>
            <li>
              Zero or more <code>a</code> elements with a <code>property</code> of
              <a>sa:roleAction</a>, one for each comment describing the author’s specific
              contribution to the work (e.g. "Authors contributed equally" or "Designed the study").
              Each of those elements needs further to have a <code>resource</code>
              attribute matching the one on the note it is pointing to and an
              <code>href</code> attribute linking to the element which contains that note. The
              <code>a</code> element may contain arbitrary text (typically a number, letter, or
              symbol matching that used by the target in its own list).
            </li>
            <li>
              Zero or one <code>ul</code> elements. Each of its <code>li</code> children has a
              <code>property</code> of <a>schema:roleContactPoint</a> and a <code>typeof</code> set
              to <a>schema:ContactPoint</a>. The content of each <code>li</code> can be anything
              that describes a manner of contacting the author in question, but it will typically
              involve properties such as <a>schema:email</a>, <a>schema:telephone</a>,
              <a>schema:address</a>, <a>schema:description</a> (for arbitrary descriptions of the
              contact method), or for journals publishing to the Web of the early 1980s
              <a>schema:faxNumber</a>.
            </li>
          </ul>
          <p>
            Here is an example of a complete kitchen sink authors’ section. Note that in most cases
            the markup will be much simpler — this exercises far more of the features than there
            is information for in a typical case.
          </p>
          <figure typeof="schema:SoftwareSourceCode" resource="#authors-example" id="authors-example">
            <pre><code>
&lt;section typeof="sa:AuthorsList">
  &lt;h2>Authors&lt;/h2>
  &lt;ul>
    &lt;li typeof="sa:ContributorRole" property="schema:author">
      &lt;span typeof="schema:Person"
            resource="https://en.wikipedia.org/wiki/John_Henry_Holland">
        &lt;meta property="schema:givenName" content="John">
        &lt;meta property="schema:additionalName" content="Henry">
        &lt;meta property="schema:familyName" content="Holland">
        &lt;span property="schema:name">John H. Holland&lt;/span>
      &lt;/span>
      &lt;a href="#sf" property="sa:roleAffiliation" resource="http://www.santafe.edu/">a&lt;/a>,
      &lt;a href="#umich" property="sa:roleAffiliation" resource="http://umich.edu/">b&lt;/a>,
      &lt;a href="#note1" property="sa:roleAction" resource="#note1" rel="footnote">1&lt;/a>
      &lt;ul>
        &lt;li property="schema:roleContactPoint" typeof="schema:ContactPoint">
          &lt;a href="mailto:jholland@umich.edu"
             property="schema:email">jholland@umich.edu&lt;/a>
        &lt;/li>
        &lt;li property="schema:roleContactPoint" typeof="schema:ContactPoint">
          &lt;a href="fax:+4815162342" property="schema:faxNumber">+4815162342&lt;/a>
        &lt;/li>
      &lt;/ul>
    &lt;/li>
  &lt;/ul>
&lt;/section>
            </code></pre>
            <figcaption>
              <span property="schema:name"></span>
              <span property="schema:description">
                Example of an author (<code>schema:contributor</code> could also have been used).
                The links to <code>#sf</code>, <code>#umich</code>, and <code>#note1</code> are
                expected to point to items in the <a href="#affiliations">Affiliations</a> section
                for the first two, and in the <a href="#meta-notes">Notes</a> section for the
                last one.
              </span>
            </figcaption>
          </figure>
        </section>
        <section id="affiliations">
          <!-- review? -->
          <h4>Affiliations</h4>
          <p>
            If the authors and contributors of the documents are affiliated with organizations, they
            are listed in a <code>section</code> with <code>typeof</code> <a>sa:Affiliations</a>.
            The content of that <code>section</code> is an <code>h2</code> title appropriate for it,
            followed by a <code>ul</code> or <code>ol</code> (but the order is less commonly
            relevant than it is for authors).
          </p>
          <p>
            Note that articles that feature an organization as an author should have that
            organization listed in the <a href="#authors">Authors &amp; Contributors</a> section,
            and <em>not</em> here.
          </p>
          <p>
            Each <code>li</code> in the list is one affiliation (though multiple people can
            reference it). The <code>li</code> needs to have an <code>id</code> matching that used
            in the reference. Inside the <code>li</code> is a <code>span</code> with
            <code>typeof</code> set to <a>schema:Organization</a> and its <code>resource</code>
            also matching the one used in the reference. (The belt and suspenders approach is
            unfortunately needed to produce both usable HTML and a viable data model.)
          </p>
          <p>
            The content of the <a>schema:Organization</a> can contain any applicable property. An
            example of an affiliations section, with some extra structure for the organization is
            given below.
          </p>
          <figure typeof="schema:SoftwareSourceCode" resource="#affiliations-example" id="affiliations-example">
            <pre><code>
&lt;section typeof="sa:Affiliations">
  &lt;h2>Affiliations&lt;/h2>
  &lt;ul>
    &lt;li id="sa">
      &lt;span typeof="schema:Organization" resource="https://science.ai/">
        &lt;span property="schema:name">science.ai&lt;/span>,
        &lt;span property="schema:parentOrganization">
          &lt;span typeof="schema:Organization">
            &lt;span property="schema:name">Standard Analytics&lt;/span>
            —
            &lt;span property="schema:location" typeof="schema:Place">
              &lt;span property="schema:address" typeof="schema:PostalAddress">
                &lt;span property="schema:addressLocality">NYC&lt;/span>,
                &lt;span property="schema:addressRegion">NY&lt;/span>,
                &lt;span property="schema:addressCountry">USA&lt;/span>
              &lt;/span>
            &lt;/span>
          &lt;/span>
        &lt;/span>
      &lt;/span>
    &lt;/li>
  &lt;/ul>
&lt;/section>
            </code></pre>
            <figcaption>
              <span property="schema:name"></span>
              <span property="schema:description">
                Example of an organization section.
              </span>
            </figcaption>
          </figure>
        </section>
        <section id="abstract-etc">
          <!-- review? -->
          <h4>License, Copyright, Keywords, and Abstract</h4>
          <p>
            The copyright line of the document can be included in any element, but it must list two
            properties. <a>schema:copyrightYear</a> has a numeric value, and
            <a>schema:copyrightHolder</a> has a value of <a>schema:Person</a> or
            <a>schema:Organization</a>.
          </p>
          <p>
            A link to the license for the article should be provided. The link should have the
            property of <a>schema:license</a> and <code>typeof="CreativeWork"</code>.
          </p>
          <!-- XXX insert simple license example to CC?-->
          <p>
            Keywords should be listed in a <code>section</code> element with an appropriate
            <code>h2</code>. The list of terms should be a <code>ul</code> with the
            <code>property</code> of <a>schema:keywords</a> on every <code>li</code>.
          </p>
          <p>
            The abstract should be included in a <code>section</code> element with
            <code>typeof</code> attribute containing <code>sa:Abstract</code>. The abstract should
            have the role of <code>doc-abstract</code>.
          </p>
        </section>
        <section id="meta-notes">
          <!-- review? -->
          <h4>Notes</h4>
          <p>
            Notes that add information about the <a href="#authors">Authors and Contributors</a>
            section should be hunk elements labeled as <code>doc-footnote</code>.
          </p>
          <!-- these are rdf:HTML? probably not -->
        </section>
      </section>
      <section id="flavored-links">
        <!-- review? -->
        <h3>Flavored Links</h3>
        <p>
          The <a href="https://www.w3.org/TR/html51/semantics.html#linkTypes"><code>rel</code></a>
          attribute should be applied to apply some spice to your links. The following values of
          <code>rel</code> should be used on the link that refers to these elements:
        </p>
        <ul>
          <li>footnote</li>
          <li>license</li>
          <li>stylesheet</li>
        </ul>
        <p class="issue">
          There are many values for rel, such as glossary and bibliography that look like they are
          useful, but based on the definition, it sounds like they point to the section containing
          the whole biblio. Not so helpful. rel="citation" or "biblioentry" would be more valuable.\
        </p>
      </section>
      <section id="citations">
        <!-- review? -->
        <h3>Citations &amp; References</h3>
        <p>
          Citations in scholarly articles provide a way to reference the work of others upon which
          one builds. In the pre-Web era, they essentially served as links by carrying sufficient
          information for one to find the reference in question, in a relatively compact manner.
        </p>
        <p>
          In a Web world, it can seem tempting to simply replace citations with links, but there is
          value in keeping the limited amount of metadata about the cited object that they provide
          inlined in the document. Links rot and disappear; when that happens the rest of the
          information can prove crucial in finding the referenced object at some other location.
          Unique identifiers with indirect resolution, such as DOIs, might seem like a solution to
          this problem but being opaque humans routinely get them wrong. (DOIs additionally suffer
          from a single point of failure for resolution.) All things considered, including a link
          for convenience and human-readable metadata about the referenced object is likely the
          most resilient way to cite another document.
        </p>
        <p>
          In the print universe, reducing the number of pages one needs to use can be a noticeable
          cost-saver. Given that scholarly articles can easily feature dozens if not hundreds of
          cited references, making use of compact reference conventions (as well as smaller font
          sizes) made sense. Over time, however, what was a sensible idea degenerated into a
          territorial maze of gratuitously heterogenous conventions to the point where there now
          exist <a href="http://citationstyles.org/">over 8000 citation styles</a>.
        </p>
        <p>
          There is no value in Scholarly HTML so much as attempting to support all citation styles.
          The Web does not need the compactness. Citations and references should be both data-rich
          and human-accessible, something on which the traditional formats fail, in some cases
          quite spectacularly.
        </p>
        <p>
          For accessibility purposes, Scholarly HTML recommends that references be formatted in such
          a manner that they read naturally in the article’s natural language, with articulations
          between the metadata parts, as below:
        </p>
        <figure typeof="schema:SoftwareSourceCode" resource="#citation-example" id="citation-example">
          <pre><code>
&lt;li typeof="schema:WebPage" role="doc-biblioentry"
    resource="http://semver.org/"
    property="schema:citation" id="some-id">
 &lt;cite property="schema:name">
   &lt;a href="http://semver.org/">Semantic Versioning 2.0.0&lt;/a>
 &lt;/cite>,
  by &lt;span property="schema:author" typeof="schema:Person">
   &lt;span property="schema:givenName">Tom&lt;/span>
   &lt;span property="schema:familyName">Preston-Werner&lt;/span>
 &lt;/span>; published in
 &lt;time property="schema:datePublished" datatype="xsd:gYear"
       datetime="2014">2014&lt;/time>
 &lt;span property="schema:potentialAction" typeof="schema:ReadAction">
   &lt;meta property="schema:actionStatus" content="CompletedActionStatus">
    (accessed on
   &lt;time property="schema:endTime" datatype="xsd:date"
         datetime="2016-02-01">01 Feb 2016&lt;/time>)
 &lt;/span>.
&lt;/li>
          </code></pre>
          <p>
            The above code renders as:
          </p>
          <ol>
            <li typeof="schema:WebPage" role="doc-biblioentry" resource="http://semver.org/"
                property="schema:citation" id="some-id">
              <cite property="schema:name">
                <a href="http://semver.org/">Semantic Versioning 2.0.0</a>
              </cite>,
              by <span property="schema:author" typeof="schema:Person">
                <span property="schema:givenName">Tom</span>
                <span property="schema:familyName">Preston-Werner</span>
              </span>; published in
              <time property="schema:datePublished" datatype="xsd:gYear" datetime="2014">2014</time>
              <span property="schema:potentialAction" typeof="schema:ReadAction">
                <meta property="schema:actionStatus" content="CompletedActionStatus">
                (accessed on
                <time property="schema:endTime" datatype="xsd:date" datetime="2016-02-01">01 Feb 2016</time>)
              </span>.
            </li>
          </ol>
          <figcaption>
            <span property="schema:name"></span>
            <span property="schema:description">
              Example of a readable citation.
            </span>
          </figcaption>
        </figure>
        <p>
          The references section is simply a <code>section</code> with an appropriate heading,
          containing an <code>ol</code>. Each <code>li</code> in the list follows a regular
          structure: it has a <code>role</code> of <code>doc-biblioentry</code>, a
          <code>resource</code> being the URL identifying the cited object, a <code>property</code>
          of <a>schema:citation</a>, and <code>id</code> to make it linkable, and a
          <code>typeof</code> capturing the kind of object that is being referenced (typically
          <a>schema:ScholarlyArticle</a>, <a>schema:Book</a>, or <a>schema:WebPage</a> but there is
          really no limit as to what may be cited).
        </p>
        <p>
          The content of the <code>li</code> can be any <a role="doc-biblioref">RDFa</a> that
          matches the <code>typeof</code>, but some good practices should be observed.
        </p>
        <p>
          The title or name of the cited object should be in a <code>cite</code> element. If a link
          is available, then the title should be linked. Date and time values (such as publication
          or access date) should make use of the <code>time</code> element (further noting that
          the <code>datatype</code> attribute can be used to express the granularity of the date as
          in the example above).
        </p>
        <p>
          While arbitrary metadata may be used, it is highly recommended to stick to
          <a role="doc-biblioref">schema.org</a> and the
          <a href="#scholarly-article">Scholarly Article</a> vocabularies. The reason for that is
          that, should one wish to convert from Scholarly HTML citations into a specific print
          format then it will be desirable to be able to reliably extract information from the
          citations. This could be used for instance to produce <a role="doc-biblioref">CSL</a>
          variables (as <a href="http://citationstyles.org/developers/">exemplified in the CSL
          documentation</a>) and then use a CSL implementation in order to produce the output.
        </p>
        <p class="issue">
          Should we be more constraining and define more precisely the constructs that are more
          likely to interoperate?
        </p>
        <p class="issue">
          Providing a mapping to CSL would be extremely useful.
        </p>
      </section>
      <section id="footnotes">
        <!-- review? -->
        <h3>Footnotes &amp; Endnotes</h3>
        <p>
          If the document has notes, they are listed in a <code>section</code> with the role of
          <code>doc-endnotes</code>. The content of that <code>section</code> is an <code>h2</code>
          title appropriate for it, followed by either a <code>ul</code> or <code>ol</code>. Each
          <code>li</code> should be labeled with the role of <code>doc-endnote</code>.
        </p>
      </section>
      <section id="funding">
        <!-- review? -->
        <h3>Funding Information</h3>
        <p>
          Funding informations is provided using a complex triples structure which can be summarized
          as follows:
        </p>
        <ul>
          <li>subject: receiver of funding (example: Author)</li>
          <li>predicate: string or sponsor role (example: wasFundedBy)</li>
          <li>object: funding organization (example: Bill &amp; Melinda Gates Foundation)</li>
        </ul>
        <p>
          This can be enhanced with information such as the award name and Role information. Here is
          a detailed example:
        </p>
        <figure typeof="schema:SoftwareSourceCode" resource="#funding-example" id="funding-example"
                role="doc-example">
          <pre><code>
XXX this example has issues
&lt;section id="funding" typeof="sa:Funding">
  &lt;h2 role="doc-title">Funding&lt;/h2>
  &lt;ol property="schema:sponsor">
    &lt;li resource="http://funding.example.org/" typeof="sa:SponsorRole">
      &lt;span typeof="schema:Person" resource="http://example.name/">
        &lt;span property="schema:name">Xiong Ding&lt;/span>
      &lt;/span>
      &lt;span property="schema:name">acknowledges support from&lt;/span>
      &lt;ul>
        &lt;li>
          &lt;span typeof="schema:Organization" resource="http://www.nuc.edu.cn/">
            &lt;a href="http://www.nuc.edu.cn/" property="schema:name">North University of China&lt;/a>
          &lt;/span>
        &lt;/li>
      &lt;/ul>
      &lt;span property="schema:roleOffer" typeof="schema:FundingSource">
        &lt;span property="schema:name">The 11th Graduate Science and Technology Projects&lt;/span>
        (&lt;span property="schema:alternateName">Natural Science Project&lt;/span>)
        &lt;span property="schema:serialNumber">20141130&lt;/span>
      &lt;/span>
    &lt;/li>
  &lt;/ol>
&lt;/section>
          </code></pre>
          <figcaption></figcaption>
        </figure>
      </section>
      <section id="disclosures">
        <!-- review? -->
        <h3>Disclosures</h3>
        <p>
          Disclosure information is a list of disclosure actions described in a simple triples
          structure.
        </p>
        <ul>
          <li>
            The subject is always one of the contributor roles (example: Author)
          </li>
          <li>
            The name of the action (nerd-talk: predicate, human-speak: verb) is a string describing
            the action (example: "received beer from")
          </li>
          <li>
            The recipient, or object, is the direct object of the sentence (example: Guinness)
          </li>
        </ul>
      </section>
      <section id="acknowledgements">
        <!-- review? -->
        <h3>Acknowledgements</h3>
        <p>
          XXX
        </p>
      </section>
    </section>
    <section id="scholarly-article">
      <!-- review? -->
      <h2>Scholarly Article Vocabulary</h2>
      <p>
        A limited number of classes and properties are currently not available from
        <a role="doc-biblioref">schema.org</a>. In most if not all cases it would be desirable to
        make them available there, but while work is progressing it is simpler to define them
        ourselves.
      </p>
      <p class="issue">
        The current URL for the Scholarly Article vocabulary is
        <code>http://ns.science.ai/</code>. It may be desirable (should the vocabulary persist) to
        use a different URL. But this issue might go away if schema.org steps up.
      </p>
      <p>
        You can read the <a href="http://ns.science.ai/">definitions for the SA vocabulary</a>.
      </p>
    </section>
    <section id="hypermedia">
      <!-- review? -->
      <h2>Hypermedia Controls</h2>
      <!--
        - explain how to model hypermedia integration, cases:
          - viewing
          - paying
          - annotating
      -->
    </section>
    <section id="processing-model">
      <!-- review? -->
      <h2>Processing Model</h2>
      <!--
        - basically explain what a processor ignores and what its internal model looks like
        - the processing extracts (almost) pure HTML, it then uses the RDFa to enrich that
      -->
    </section>
    <section id="acks">
      <!-- review? -->
      <h2>Acknowledgements</h2>
      <p>
        Scholarly HTML would like to thank <a href="http://scholarlyhtml.org/">Scholarly HTML</a>
        (you read that right) for blazing the trail perhaps a few years too soon. Particularly,
        the following people were particularly kind and helpful:
        <a href="https://twitter.com/ptsefton">Peter Sefton</a>,
        <a href="https://twitter.com/blahah404">Richard Smith-Unna</a>, and
        <a href="https://twitter.com/petermurrayrust">Peter Murray-Rust</a>.
      </p>
      <p>
        PLOS has a
        <a href="http://blogs.plos.org/mfenner/2011/03/19/a-very-brief-history-of-scholarly-html/">short
        history of Scholarly HTML</a> that is worth reading (and would be worth updating).
      </p>
      <p>
        Dan Brickley was kind enough to drop by the office to chat about our usage of
        <a href="http://schema.org">schema.org</a> even though he was tired and hungry. As
        always, examples involving fish tanks are the most helpful. Dave Cramer shared ideas
        that we happily stole.
      </p>
      <p>
        Patrick Johnston’s input has been crucial, notably in modeling authoring. We can only
        hope that getting those details exactly right have not caused him to lose too much
        sleep.
      </p>
      <p>
        We also received very useful feedback and pointers from: Kjetil Kjernsmo (DAHUT!),
        Silvio Peroni, Justin Johansson, Alf Eaton, Raniere Silvia, Kaveh Bazargan and Mike
        Smith. We are very much indebted to the help provided us by Ivan Herman.
      </p>
      <p>
        If we somehow forgot you in this list and you are too gracious to complain, we love you
        all the same.
      </p>
    </section>
  </body>
</html>
