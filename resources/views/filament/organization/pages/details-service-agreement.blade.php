<div class="max-h-[60vh] overflow-y-auto space-y-4 text-sm text-gray-300">
    @if($organization)
        <p><strong>LEGAL NAME:</strong> {{ $organization->name }} - {{ $organization->contact_full_name }}</p>
        <p><strong>ADDRESS:</strong> {{ $organization->organization_address }} {{ $organization->organization_zip }}</p>
        <p><strong>COUNTRY:</strong> {{ $organization->organization_state }}</p>

        <div class="mt-4 space-y-3">
            <p>
                <strong>COUNTRY:</strong> {{ $organization->organization_state }}
            </p>
            <p>
                This Software License Agreement (this "Agreement"), dated {{ $organization->date_of_registration?->format('M d, Y') ?? 'N/A' }}
                (the "Effective Date"), is entered into by and between {{ $organization->name }} ("End User"),
                a company domiciled in {{ $organization->organization_state }} and having their principal office as set forth above
                OR NAME OF INDIVIDUAL, an individual with a address of as set forth above and Construction Services Alliance LLC,
                an Ohio company having its principal place of business at UPDATE ADDRESS ("CSA")
            </p>

            <h4 class="text-primary-500 font-semibold mt-6">1. &nbsp; CERTAIN DEFINITIONS</h4>

            <p class="pl-8">
                <strong>1.1</strong> &nbsp; The term "CSA" refers to Construction Services Alliance LLC.
            </p>
            <p class="pl-8">
                <strong>1.2</strong> &nbsp; The term "End User" refers to the entity entering into this Agreement with CSA
                and to whom CSA is granting a license to use and the right to access its Information, as set forth in Section 2
                below and on the terms and subject to the conditions of this Agreement. For purposes of this Agreement,
                the term "person" means an individual, corporation, partnership, limited liability company, government
                jurisdiction or agency or other entity on whose behalf the CSA Information is being used or obtained.
            </p>
            <p class="pl-8">
                <strong>1.3</strong> &nbsp; The terms "Products" and "Services" mean the computer software and all other
                modifications, updates, upgrades or enhancements that CSA, in its sole discretion, in the future shall
                create and make available under the terms of this Agreement.
            </p>
            <p class="pl-8">
                <strong>1.4</strong> &nbsp; The term "Data" means the data, reports, and related information provided by CSA
                to the End User through the Products, Services, Site or otherwise.
            </p>
            <p class="pl-8">
                <strong>1.5</strong> &nbsp; The term "Site" means the web sites at WEB ADDRESS IF THE SOFTWARE IS A SAAS OFFERING
                but also includes any other web site that CSA may own or operate in the future, and any mobile applications
                created by CSA, for delivering the Data, Products, and/or Services.
            </p>
        </div>
    @else
        <p>No organization data available.</p>
    @endif
</div>
