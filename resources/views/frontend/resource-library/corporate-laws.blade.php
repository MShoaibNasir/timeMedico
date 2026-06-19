@extends('frontend.layout.master')
@section('content')
<!-- <style>
/* Zebra Rows */
.custom-table tbody tr:nth-child(odd) {
    background-color: #ffffff;
}

.custom-table tbody tr:nth-child(even) {
    background-color: #f0f0f0d0;
}

/* Hover Effect */
.custom-table tbody tr:hover {
    background-color: #e9ecef;
    transition: 0.3s ease;
}

/* Button Hover */
.btn-primary:hover {
    background-color: #0b5ed7;
    transform: translateY(-1px);
    transition: 0.2s ease;
}

/* Mobile Responsive */
@media (max-width: 768px) {

    .custom-table thead {
        display: none;
    }

    .custom-table,
    .custom-table tbody,
    .custom-table tr,
    .custom-table td {
        display: block;
        width: 100%;
    }

    .custom-table tr {
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 8px;
        background: #fff;
    }

    .custom-table td {
        text-align: left;
        padding: 6px 10px;
    }

    .custom-table td.text-center {
        text-align: left !important;
    }
}
</style> -->
<section class="flat-title-page">
    <div class="container">
        <h3 class="fw-semibold text-black pb-3">Corporate Laws</h3>
        <div class="py-3">
            <span class="fw-bold py-4">SECP: </span><a class="text-success" href="https://www.secp.gov.pk/laws/acts/" target="_blank"
                rel="noopener noreferrer">https://www.secp.gov.pk/laws/acts/</a>
        </div>


        <div class="card shadow-sm border-1 rounded-2">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">Name</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>1</td>

                                <td class="fw-semibold">
                                    Acts
                                </td>

                                <td class="text-center">
                                    <a href="https://www.secp.gov.pk/laws/acts/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>

                                <td class="fw-semibold">
                                    Ordinances
                                </td>

                                <td class="text-center">
                                    <a href="https://www.secp.gov.pk/laws/ordinances/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>

                                <td class="fw-semibold">
                                    Rules
                                </td>

                                <td class="text-center">
                                    <a href="https://www.secp.gov.pk/laws/rules/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>

                                <td class="fw-semibold">
                                    Regulations
                                </td>

                                <td class="text-center">
                                    <a href="https://www.secp.gov.pk/laws/regulations/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>5</td>

                                <td class="fw-semibold">
                                    Notifications
                                </td>

                                <td class="text-center">
                                    <a href="https://www.secp.gov.pk/laws/notifications/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>


                            <tr>
                                <td>6</td>

                                <td class="fw-semibold">
                                    Directives
                                </td>

                                <td class="text-center">
                                    <a href="https://www.secp.gov.pk/laws/directives/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>


                            <tr>
                                <td>7</td>

                                <td class="fw-semibold">
                                    Guidelines
                                </td>

                                <td class="text-center">
                                    <a href="https://www.secp.gov.pk/laws/guidelines/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>8</td>

                                <td class="fw-semibold">
                                    Circulars
                                </td>

                                <td class="text-center">
                                    <a href="https://www.secp.gov.pk/laws/circulars/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>9</td>

                                <td class="fw-semibold">
                                    Regulations
                                </td>

                                <td class="text-center">
                                    <a href="https://www.secp.gov.pk/laws/regulations/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>10</td>

                                <td class="fw-semibold">
                                    Draft Laws
                                </td>

                                <td class="text-center">
                                    <a href="https://www.secp.gov.pk/laws/drafts-for-discussion/rules/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>11</td>

                                <td class="fw-semibold">
                                    Draft Rules, regulations and Concepts
                                </td>

                                <td class="text-center">
                                    <a href="https://www.secp.gov.pk/laws/drafts-for-discussion/draft-rules-regulations/"
                                        target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>12</td>

                                <td class="fw-semibold">
                                    Others
                                </td>

                                <td class="text-center">
                                    <a href="https://www.secp.gov.pk/laws/others/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- <div class="container">
        <h4 class="my-4">State Bank of Pakistan</h4>
        <div class="card shadow-sm border-1 rounded-2">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">Name</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>1</td>

                                <td class="fw-semibold">
                                    Laws & Regulations
                                </td>

                                <td class="text-center">
                                    <a href="https://www.sbp.org.pk/l_frame/index2.asp" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>

                                <td class="fw-semibold">
                                    Circulars/Notifications
                                </td>

                                <td class="text-center">
                                    <a href="https://www.sbp.org.pk/circulars/index.asp" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>

                                <td class="fw-semibold">
                                    Monetary Policy
                                </td>

                                <td class="text-center">
                                    <a href="https://www.sbp.org.pk/m_policy/index.asp" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>

                                <td class="fw-semibold">
                                    Publications
                                </td>

                                <td class="text-center">
                                    <a href="https://www.sbp.org.pk/publications/index2.asp" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>5</td>

                                <td class="fw-semibold">
                                    Financial Data
                                </td>

                                <td class="text-center">
                                    <a href="https://www.sbp.org.pk/ecodata/index2.asp" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>


                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <h4 class="my-4">State-Owned and Public-Sector</h4>
        <div class="card shadow-sm border-1 rounded-2">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">Name</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>1</td>

                                <td class="fw-semibold">
                                    Public Sector Companies Rules and Guidelines
                                </td>

                                <td class="text-center">
                                    <a href="https://www.secp.gov.pk/corporate-governance/public-sector-companies/"
                                        target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>

                                <td class="fw-semibold">
                                    State-Owned Enterprises (Governance and Operations) Act, 2023
                                </td>

                                <td class="text-center">
                                    <a href="https://www.finance.gov.pk/publications/SOEs_Policy_Report_2023.pdf"
                                        target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>

                                <td class="fw-semibold">
                                    State-Owned Enterprises (Policy) Act, 2023
                                </td>

                                <td class="text-center">
                                    <a href="https://www.finance.gov.pk/publications/SOEs_Policy_Report_2023.pdf "
                                        target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>

                                <td class="fw-semibold">
                                    Insurance Companies
                                </td>

                                <td class="text-center">
                                    <a href="https://www.secp.gov.pk/corporate-governance/insurance-companies-code/"
                                        target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>5</td>

                                <td class="fw-semibold">
                                    Non-Listed Companies
                                </td>

                                <td class="text-center">
                                    <a href="https://www.secp.gov.pk/corporate-governance/non-listed-companies/"
                                        target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>


                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <h4 class="my-4">PICG Quorum</h4>
        <a href=" https://picg.org.pk/directors-quorum/" target="_blank" rel="noopener noreferrer">
            https://picg.org.pk/directors-quorum/</a>

        <h4 class="my-4">PICG Thought Leadership</h4>
        <div class="card shadow-sm border-1 rounded-2">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">Name</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>1</td>

                                <td class="fw-semibold">
                                    Governance updates
                                </td>

                                <td class="text-center">
                                    <a href="https://picg.org.pk/governance-updates/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>

                                <td class="fw-semibold">
                                    Research Papers
                                </td>

                                <td class="text-center">
                                    <a href="https://picg.org.pk/research-papers/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>

                                <td class="fw-semibold">
                                    Collaborative Research and Surveys
                                </td>

                                <td class="text-center">
                                    <a href="https://picg.org.pk/collaborative-research-surveys/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>



                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <h4 class="my-4">POECD (Organisation for Economic Co-operation and Development)</h4>
        <div class="card shadow-sm border-1 rounded-2">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">Name</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>1</td>

                                <td class="fw-semibold">
                                    Reports and Research Papers
                                </td>

                                <td class="text-center">
                                    <a href="https://www.oecd.org/en/publications/reports.html" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>

                                <td class="fw-semibold">
                                    Policy papers & Briefs
                                </td>

                                <td class="text-center">
                                    <a href="https://www.oecd.org/en/publications/briefs.html " target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <h4 class="my-4">Reports & Updates</h4>
        <div class="card shadow-sm border-1 rounded-2">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">Name</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>1</td>

                                <td class="fw-semibold">
                                    - Governance Highlights
                                </td>

                                <td class="text-center">
                                    <a href="https://picg.org.pk/governance-updates/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>

                                <td class="fw-semibold">
                                    - SME Case Studies
                                </td>

                                <td class="text-center">
                                    <a href="https://picg.org.pk/sme-case-studies/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>

                                <td class="fw-semibold">
                                    - Research Publications
                                </td>

                                <td class="text-center">
                                    <a href="https://picg.org.pk/research-publications/ " target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <h4 class="my-4">Reports & Updates</h4>
        <div class="card shadow-sm border-1 rounded-2">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">Name</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>1</td>

                                <td class="fw-semibold">
                                    - Governance Highlights
                                </td>

                                <td class="text-center">
                                    <a href="https://picg.org.pk/governance-updates/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>

                                <td class="fw-semibold">
                                    - SME Case Studies
                                </td>

                                <td class="text-center">
                                    <a href="https://picg.org.pk/sme-case-studies/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>

                                <td class="fw-semibold">
                                    - Research Publications
                                </td>

                                <td class="text-center">
                                    <a href="https://picg.org.pk/research-publications/ " target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <h4 class="my-4">RCorporate Governance & ESG Best Practice Resources</h4>
        <div class="card shadow-sm border-1 rounded-2">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">Name</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>1</td>

                                <td class="fw-semibold">
                                    Presgo – ESG Reporting Best Practices & Examples
                                </td>

                                <td class="text-center">
                                    <a href="https://presgo.com/blog/esg-reporting-best-practices-examples/ "
                                        target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>

                                <td class="fw-semibold">
                                    Corporate Governance Institute – Mastering ESG Reporting
                                </td>

                                <td class="text-center">
                                    <a href="https://www.thecorporategovernanceinstitute.com/insights/lexicon/mastering-esg-reporting/ "
                                        target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>

                                <td class="fw-semibold">
                                    PwC – ESG Reporting & Sustainability Guidance
                                </td>

                                <td class="text-center">
                                    <a href="https://www.pwc.com/gx/en/services/esg/reporting.html " target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            </tr>

                            <tr>
                                <td>4</td>

                                <td class="fw-semibold">
                                    OECD – G20/OECD Principles of Corporate Governance
                                </td>

                                <td class="text-center">
                                    <a href="https://www.oecd.org/corporate/principles-corporate-governance/ "
                                        target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            </tr>

                            <tr>
                                <td>5</td>

                                <td class="fw-semibold">
                                    IFC – Corporate Governance Methodology & Toolkits
                                </td>

                                <td class="text-center">
                                    <a href="https://www.ifc.org/corporategovernance " target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            </tr>

                            <tr>
                                <td>6</td>

                                <td class="fw-semibold">
                                    World Economic Forum – Measuring Stakeholder Capitalism (ESG Metrics)
                                </td>

                                <td class="text-center">
                                    <a href="https://www.weforum.org/reports/measuring-stakeholder-capitalism "
                                        target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            </tr>

                            <tr>
                                <td>7</td>

                                <td class="fw-semibold">
                                    UN Global Compact – Sustainability & ESG Library
                                </td>

                                <td class="text-center">
                                    <a href="https://www.unglobalcompact.org/library/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            </tr>

                            <tr>
                                <td>8</td>

                                <td class="fw-semibold">
                                    GRI – Global Reporting Initiative Standards
                                </td>

                                <td class="text-center">
                                    <a href="https://www.globalreporting.org/standards/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            </tr>

                            <tr>
                                <td>9</td>

                                <td class="fw-semibold">
                                    SASB/ISSB – Industry Specific ESG Standards
                                </td>

                                <td class="text-center">
                                    <a href="https://www.sasb.org/standards/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>10</td>

                                <td class="fw-semibold">
                                    BlackRock – Corporate Governance & Stewardship Principles
                                </td>

                                <td class="text-center">
                                    <a href="https://www.blackrock.com/corporate/about-us/investment-stewardship "
                                        target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <h4 class="my-4">Technology, AI & Cybersecurity </h4>
        <div class="card shadow-sm border-1 rounded-2">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">Name</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>1</td>

                                <td class="fw-semibold">
                                    Cyber Pulse: An AI Security Report (Microsoft)
                                </td>

                                <td class="text-center">
                                    <a href="https://securityinsider.microsoft.com/cyber-pulse" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>

                                <td class="fw-semibold">
                                    World Bank – Global Trends in AI Governance (2024)
                                </td>

                                <td class="text-center">
                                    <a href="https://www.worldbank.org/en/topic/digitaldevelopment/publication/global-trends-in-ai-governance "
                                        target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>

                                <td class="fw-semibold">
                                    Cyber Institute – Technology Governance Report
                                </td>

                                <td class="text-center">
                                    <a href="https://cyber-institute.org/technology-governance-report " target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>

                                <td class="fw-semibold">
                                    Cyber Institute – Technology Governance Report
                                </td>

                                <td class="text-center">
                                    <a href="https://cyber-institute.org/technology-governance-report" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>

                                <td class="fw-semibold">
                                    OECD – AI Principles & Governance Framework
                                </td>

                                <td class="text-center">
                                    <a href="https://oecd.ai/en/ai-principles " target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>5</td>

                                <td class="fw-semibold">
                                    NIST – AI Risk Management Framework (AI RMF)
                                </td>

                                <td class="text-center">
                                    <a href="https://www.nist.gov/itl/ai-risk-management-framework" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>6</td>

                                <td class="fw-semibold">
                                    ENISA – European Cybersecurity Threat Landscape Report
                                </td>

                                <td class="text-center">
                                    <a href="https://www.enisa.europa.eu/publications" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>7</td>

                                <td class="fw-semibold">
                                    World Economic Forum – Global Cybersecurity Outlook
                                </td>

                                <td class="text-center">
                                    <a href="https://www.weforum.org/reports/global-cybersecurity-outlook"
                                        target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>8</td>

                                <td class="fw-semibold">
                                    MIT Technology Review – State of AI Governance
                                </td>

                                <td class="text-center">
                                    <a href="https://www.technologyreview.com/topic/ai-governance" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>9</td>

                                <td class="fw-semibold">
                                    IBM – Cost of a Data Breach Report
                                </td>

                                <td class="text-center">
                                    <a href="https://www.ibm.com/reports/data-breach" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>9</td>

                                <td class="fw-semibold">
                                    Microsoft – Responsible AI Standard (v2)
                                </td>

                                <td class="text-center">
                                    <a href="https://www.microsoft.com/ai/responsible-ai " target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <h4 class="my-4">ESG & Sustainability</h4>
        <div class="card shadow-sm border-1 rounded-2">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">Name</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>1</td>

                                <td class="fw-semibold">
                                    PICG Guide to ESG
                                </td>

                                <td class="text-center">
                                    <a href="https://picg.org.pk/guide-to-esg/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>

                                <td class="fw-semibold">
                                    PICG ESG Tracks
                                </td>

                                <td class="text-center">
                                    <a href="https://esgtracks.picg.org.pk/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>

                                <td class="fw-semibold">
                                    SECP’s ESG Sustain
                                </td>

                                <td class="text-center">
                                    <a href="https://esgsustain.secp.gov.pk/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <h4 class="my-4">Professional Frameworks</h4>
        <div class="card shadow-sm border-1 rounded-2">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table custom-table align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">Name</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>1</td>

                                <td class="fw-semibold">
                                    International Financial Reporting Frameworks
                                </td>

                                <td class="text-center">
                                    <a href="https://www.ifrs.org/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>

                                <td class="fw-semibold">
                                    Sustainability Accounting Standards Board
                                </td>

                                <td class="text-center">
                                    <a href="https://www.ifrs.org/issued-standards/sasb-standards/#overview"
                                        target="_blank" class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>

                                <td class="fw-semibold">
                                    The International Professional Practices Framework® (IPPF®) from The Institute of
                                    Internal Auditors
                                </td>

                                <td class="text-center">
                                    <a href="https://www.theiia.org/en/standards/" target="_blank"
                                        class="btn btn-sm btn-primary  px-4">
                                        Read More
                                    </a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div> -->

</section>

@endsection