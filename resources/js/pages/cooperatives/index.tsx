import AppLayout from '@/layouts/app-layout';
import type { BreadcrumbItem } from '@/types';
import coopRoutes from '@/routes/cooperatives';
import { Head, Link, router } from '@inertiajs/react';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { MoreHorizontal, Search, Eye, Edit, Trash2 } from 'lucide-react';
import { useState } from 'react';
import { useDebouncedCallback } from 'use-debounce';

type Cooperative = {
    id: number;
    uuid: string;
    name: string;
    region: string;
    address?: string | null;
    contact_person?: string | null;
    phone?: string | null;
};

type PaginationLink = {
    url: string | null;
    label: string;
    active: boolean;
};

type PaginatedData = {
    data: Cooperative[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    links: PaginationLink[];
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Cooperatives',
        href: coopRoutes.index().url,
    },
];

export default function Index({
    cooperatives,
    filters
}: {
    cooperatives: PaginatedData;
    filters: { search?: string }
}) {
    const [confirmDelete, setConfirmDelete] = useState<string | null>(null);

    const debouncedSearch = useDebouncedCallback((value: string) => {
        router.get(coopRoutes.index().url,
            { search: value || undefined },
            { preserveState: true, replace: true }
        );
    }, 300);

    const handleDelete = (uuid: string) => {
        router.delete(coopRoutes.destroy(uuid).url, {
            onSuccess: () => setConfirmDelete(null),
        });
    };
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Cooperatives" />

            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
        <div className="flex items-center justify-between">
                <Link
                    href={coopRoutes.create().url}
                    className="inline-flex items-center px-3 py-1.5 rounded-md bg-primary text-white hover:opacity-95"
                >
                    Create cooperative
                </Link>


            <div className="mb-6">
                <div className="relative max-w-sm">
                    <Search className="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-muted-foreground" />
                    <Input
                        placeholder="Search cooperatives..."
                        defaultValue={filters.search || ''}
                        onChange={(e) => debouncedSearch(e.target.value)}
                        className="pl-9"
                    />
                </div>
            </div>
            </div>

            <div className="overflow-hidden rounded-lg border border-sidebar-border/70 dark:border-sidebar-border">
                <table className="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead className="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th className="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Name</th>
                            <th className="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Region</th>
                            <th className="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Address</th>
                            <th className="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Contact</th>
                            <th className="px-4 py-3 text-left text-sm font-medium text-muted-foreground">Phone</th>
                            <th className="px-4 py-3 text-right text-sm font-medium text-muted-foreground">Actions</th>
                        </tr>
                    </thead>

                    <tbody className="bg-background dark:bg-transparent divide-y divide-gray-200 dark:divide-gray-800">
                        {cooperatives.data.length === 0 ? (
                            <tr>
                                <td colSpan={6} className="py-8 text-center text-sm text-muted-foreground">
                                    {filters.search ? 'No cooperatives match your search.' : 'No cooperatives found.'}
                                </td>
                            </tr>
                        ) : (
                            cooperatives.data.map((item: Cooperative) => (
                                <tr key={item.uuid} className="hover:bg-muted/5 dark:hover:bg-muted/10">
                                    <td className="px-4 py-3 text-sm text-foreground">{item.name}</td>
                                    <td className="px-4 py-3 text-sm text-foreground">{item.region}</td>
                                    <td className="px-4 py-3 text-sm text-foreground">{item.address ?? '—'}</td>
                                    <td className="px-4 py-3 text-sm text-foreground">{item.contact_person ?? '—'}</td>
                                    <td className="px-4 py-3 text-sm text-foreground">{item.phone ?? '—'}</td>
                                    <td className="px-4 py-3 text-sm text-right">
                                        <DropdownMenu>
                                            <DropdownMenuTrigger asChild>
                                                <Button variant="ghost" className="h-8 w-8 p-0">
                                                    <MoreHorizontal className="h-4 w-4" />
                                                </Button>
                                            </DropdownMenuTrigger>
                                            <DropdownMenuContent align="end">
                                                <DropdownMenuItem asChild>
                                                    <Link href={coopRoutes.show(item.uuid).url} className="flex items-center">
                                                        <Eye className="mr-2 h-4 w-4" />
                                                        View
                                                    </Link>
                                                </DropdownMenuItem>
                                                <DropdownMenuItem asChild>
                                                    <Link href={coopRoutes.edit(item.uuid).url} className="flex items-center">
                                                        <Edit className="mr-2 h-4 w-4" />
                                                        Edit
                                                    </Link>
                                                </DropdownMenuItem>
                                                <DropdownMenuItem
                                                    onClick={() => setConfirmDelete(item.uuid)}
                                                    className="flex items-center text-destructive focus:text-destructive"
                                                >
                                                    <Trash2 className="mr-2 h-4 w-4" />
                                                    Delete
                                                </DropdownMenuItem>
                                            </DropdownMenuContent>
                                        </DropdownMenu>
                                    </td>
                                </tr>
                            ))
                        )}
                    </tbody>
                </table>
            </div>

            {/* Pagination */}
            {cooperatives.last_page > 1 && (
                <div className="flex items-center justify-between mt-6">
                    <div className="text-sm text-muted-foreground">
                        Showing {((cooperatives.current_page - 1) * cooperatives.per_page) + 1} to{' '}
                        {Math.min(cooperatives.current_page * cooperatives.per_page, cooperatives.total)} of{' '}
                        {cooperatives.total} results
                    </div>
                    <div className="flex items-center gap-2">
                        {cooperatives.links.map((link, index) => {
                            if (!link.url) {
                                return (
                                    <Button
                                        key={index}
                                        variant="outline"
                                        size="sm"
                                        disabled
                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                    />
                                );
                            }

                            return (
                                <Link
                                    key={index}
                                    href={link.url}
                                    preserveState
                                    className={`inline-flex items-center px-3 py-1.5 text-sm rounded-md border transition-colors ${link.active
                                        ? 'bg-primary text-primary-foreground border-primary'
                                        : 'bg-background hover:bg-muted border-input'
                                        }`}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                />
                            );
                        })}
                    </div>
                </div>
            )}

            {/* Delete Confirmation Dialog */}
            {confirmDelete && (
                <div className="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                    <div className="bg-background rounded-lg p-6 max-w-md w-full mx-4 border">
                        <h3 className="text-lg font-semibold mb-2">Confirm Delete</h3>
                        <p className="text-sm text-muted-foreground mb-6">
                            Are you sure you want to delete this cooperative? This action cannot be undone.
                        </p>
                        <div className="flex justify-end gap-3">
                            <Button
                                variant="outline"
                                onClick={() => setConfirmDelete(null)}
                            >
                                Cancel
                            </Button>
                            <Button
                                variant="destructive"
                                onClick={() => handleDelete(confirmDelete)}
                            >
                                Delete
                            </Button>
                        </div>
                    </div>
                </div>
            )}
            </div>
        </AppLayout>
    );
}
