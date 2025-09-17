import AppLayout from '@/layouts/app-layout';
import type { BreadcrumbItem } from '@/types';
import cooperatives from '@/routes/cooperatives';
import { Head, Link } from '@inertiajs/react';

type Cooperative = {
    id: number;
    uuid: string;
    name: string;
    region: string;
    address?: string | null;
    contact_person?: string | null;
    phone?: string | null;
    email?: string | null;
    website?: string | null;
    registration_number?: string | null;
    registration_date?: string | null;
    number_of_members?: number | null;
    offer?: string | null;
    status?: string | null;
};

const breadcrumbs = (cooperative: Cooperative): BreadcrumbItem[] => [
    {
        title: 'Cooperatives',
        href: cooperatives.index().url,
    },
    {
        title: cooperative.name,
        href: cooperatives.show(cooperative.uuid).url,
    },
];

export default function Show({ cooperative }: { cooperative: Cooperative }) {
    return (
        <AppLayout breadcrumbs={breadcrumbs(cooperative)}>
            <Head title={`${cooperative.name} — Cooperative Details`} />

            <div className="space-y-6">
                <div className="flex items-center justify-between">
                    <h1 className="text-lg font-medium">{cooperative.name}</h1>
                    <div className="flex gap-2">
                        <Link
                            href={cooperatives.edit(cooperative.uuid).url}
                            className="inline-flex items-center px-3 py-1.5 rounded-md bg-primary text-white hover:opacity-95"
                        >
                            Edit
                        </Link>
                    </div>
                </div>

                <div className="rounded-lg border border-sidebar-border/70 dark:border-sidebar-border p-6">
                    <div className="grid gap-6 md:grid-cols-2">
                        <div>
                            <h3 className="text-sm font-medium text-muted-foreground mb-1">Name</h3>
                            <p className="text-sm">{cooperative.name}</p>
                        </div>

                        <div>
                            <h3 className="text-sm font-medium text-muted-foreground mb-1">Region</h3>
                            <p className="text-sm">{cooperative.region}</p>
                        </div>

                        {cooperative.address && (
                            <div>
                                <h3 className="text-sm font-medium text-muted-foreground mb-1">Address</h3>
                                <p className="text-sm">{cooperative.address}</p>
                            </div>
                        )}

                        {cooperative.contact_person && (
                            <div>
                                <h3 className="text-sm font-medium text-muted-foreground mb-1">Contact Person</h3>
                                <p className="text-sm">{cooperative.contact_person}</p>
                            </div>
                        )}

                        {cooperative.phone && (
                            <div>
                                <h3 className="text-sm font-medium text-muted-foreground mb-1">Phone</h3>
                                <p className="text-sm">{cooperative.phone}</p>
                            </div>
                        )}

                        {cooperative.email && (
                            <div>
                                <h3 className="text-sm font-medium text-muted-foreground mb-1">Email</h3>
                                <p className="text-sm">{cooperative.email}</p>
                            </div>
                        )}

                        {cooperative.website && (
                            <div>
                                <h3 className="text-sm font-medium text-muted-foreground mb-1">Website</h3>
                                <p className="text-sm">
                                    <a href={cooperative.website} target="_blank" rel="noopener noreferrer" className="text-primary underline">
                                        {cooperative.website}
                                    </a>
                                </p>
                            </div>
                        )}

                        {cooperative.registration_number && (
                            <div>
                                <h3 className="text-sm font-medium text-muted-foreground mb-1">Registration Number</h3>
                                <p className="text-sm">{cooperative.registration_number}</p>
                            </div>
                        )}

                        {cooperative.registration_date && (
                            <div>
                                <h3 className="text-sm font-medium text-muted-foreground mb-1">Registration Date</h3>
                                <p className="text-sm">{new Date(cooperative.registration_date).toLocaleDateString()}</p>
                            </div>
                        )}

                        {cooperative.number_of_members && (
                            <div>
                                <h3 className="text-sm font-medium text-muted-foreground mb-1">Number of Members</h3>
                                <p className="text-sm">{cooperative.number_of_members.toLocaleString()}</p>
                            </div>
                        )}

                        {cooperative.offer && (
                            <div>
                                <h3 className="text-sm font-medium text-muted-foreground mb-1">Offer</h3>
                                <p className="text-sm">{cooperative.offer}</p>
                            </div>
                        )}

                        {cooperative.status && (
                            <div>
                                <h3 className="text-sm font-medium text-muted-foreground mb-1">Status</h3>
                                <p className="text-sm">{cooperative.status}</p>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
