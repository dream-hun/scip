import AppLayout from '@/layouts/app-layout';
import type { BreadcrumbItem } from '@/types';
import cooperatives from '@/routes/cooperatives';
import { Head, Form, Link } from '@inertiajs/react';

import InputError from '@/components/input-error';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';

const breadcrumbsBase = (cooperativeId?: string | number): BreadcrumbItem[] => [
    {
        title: 'Cooperatives',
        href: cooperatives.index().url,
    },
    {
        title: cooperativeId ? 'Edit' : 'Edit cooperative',
        href: cooperativeId ? cooperatives.edit(cooperativeId).url : cooperatives.index().url,
    },
];

export default function Edit({ cooperative }: { cooperative: any }) {
    return (
        <AppLayout breadcrumbs={breadcrumbsBase(cooperative?.uuid)}>
            <Head title={`Edit cooperative — ${cooperative?.name ?? ''}`} />

            <div className="space-y-6">
                <div className="rounded-lg border border-sidebar-border/70 dark:border-sidebar-border p-4">
                    <Form
                        action={cooperatives.update(cooperative.uuid).url}
                        method="post"
                        options={{ preserveScroll: true }}
                        data={{ _method: 'PATCH' }}
                        className="space-y-6"
                    >
                        {({ processing, errors }) => (
                            <>
                                <div className="grid gap-2">
                                    <Label htmlFor="name">Name</Label>
                                    <Input id="name" name="name" defaultValue={cooperative.name} placeholder="Cooperative name" />
                                    <InputError message={errors.name} className="mt-2" />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="region">Region</Label>
                                    <Input id="region" name="region" defaultValue={cooperative.region} placeholder="Region" />
                                    <InputError message={errors.region} className="mt-2" />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="address">Address</Label>
                                    <Input id="address" name="address" defaultValue={cooperative.address} placeholder="Street address or PO Box" />
                                    <InputError message={errors.address} className="mt-2" />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="contact_person">Contact person</Label>
                                    <Input id="contact_person" name="contact_person" defaultValue={cooperative.contact_person} placeholder="Full name" />
                                    <InputError message={errors.contact_person} className="mt-2" />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="phone">Phone</Label>
                                    <Input id="phone" name="phone" defaultValue={cooperative.phone} placeholder="Phone number" />
                                    <InputError message={errors.phone} className="mt-2" />
                                </div>

                                <div className="flex items-center gap-3 justify-end">
                                    <Link href={cooperatives.index().url} className="underline text-muted-foreground">Cancel</Link>
                                    <Button type="submit" disabled={processing}>Save</Button>
                                </div>
                            </>
                        )}
                    </Form>
                </div>
            </div>
        </AppLayout>
    );
}
