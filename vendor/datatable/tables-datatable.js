$(function(){var e=$("#datatable1").DataTable({"pageLength": 25, "language": {"url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"}, responsive:{details:!1}});$(document).on("sidebarChanged",function(){e.columns.adjust(),e.responsive.recalc(),e.responsive.rebuild()})});