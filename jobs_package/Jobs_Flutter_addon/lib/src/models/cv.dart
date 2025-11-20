class CvDocument {
  const CvDocument({required this.id, required this.url, required this.template});

  final int id;
  final String url;
  final String template;

  factory CvDocument.fromJson(Map<String, dynamic> json) => CvDocument(
        id: json['id'] as int,
        url: json['url'] as String,
        template: json['template'] as String? ?? 'default',
      );

  Map<String, dynamic> toJson() => {
        'id': id,
        'url': url,
        'template': template,
      };
}
